<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $fio Real name User
 * @property string $phone Phone by User
 * @property string $agency
 * @property string $role
 * @property string $valid_token
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_DEFAULT = 'user';

    // Need for change password
    public $new_password;
    public $old_password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'required', 'on' => 'update'],
            [['role'], 'string', 'max' => 10],
            [['phone'], 'string', 'length' => 12],

            [['new_password', 'old_password'],  'string', 'max' => 50, 'min'=>6],
            [['new_password', 'old_password'],  'required', 'on' => 'change'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот E-mail уже занят.'],

            [['agency', 'fio'], 'string', 'max' => 50],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',

            'fio' => 'Имя пользователя',
            'info' => 'Инфо',
            'phone' => 'Телефон',
            'role' => 'Права',
            'agency' => 'Агентство',
            'status' => 'Статус пользователя',
        ];
    }


    public function AllStatus()
    {
        $status = [self::STATUS_ACTIVE=>'Активен', self::STATUS_DELETED => 'Заблокирован'];
        return $status;
    }

    /**
     * Finds user by email. Modify from http://scovol.net/2014/07/10/yii2-authenticating-by-email-address/
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * @return string
     */
    public function generateValidToken()
    {
        return Yii::$app->security->generateRandomString();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @author Nikolay
     * Get All role from RBAC
     * @return array
     */
    public static function getAllRoles()
    {
        $roles = array();
        foreach (Yii::$app->authManager->getRoles() as $role)
        {
            $roles[$role->name] = $role->description;
        }

        return $roles;
    }

    /**
     * @author Nikolay
     * Sends an email with a link, for valid user
     *
     * @return boolean whether the email was send
     */
    public function sendValid_email()
    {

          return \Yii::$app->mailer->compose(['html' => 'mailValidate-html', 'text' => 'mailValidate-text'], ['user' => $this])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Подтверждение E-mail ' . \Yii::$app->name)
                    ->send();

    }

    public function checkEmail($token)
    {
        if ($token==$this->valid_token)
        {
            $this->valid_token = null;
            return true;
        }
        else
            return false;

    }

    /**
     * Set role in Base
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if ($this->isNewRecord)
        {

            $this->valid_token = $this->generateValidToken();
            $this->role = User::ROLE_DEFAULT;
        }
        return true;
    }

    /**
     * @author Nikolay
     * Assignment Default role "user"
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave ($insert, $changedAttributes)
    {
        if ($insert) // Check new record. Analog isNewRecord.
        {
            parent::afterSave($insert, $changedAttributes);
            // Assigned Role for user

            $userRole = Yii::$app->authManager->getRole(User::ROLE_DEFAULT);
            Yii::$app->authManager->assign($userRole, $this->id);
            $this->sendValid_email();

        }
        else
        {

            // Update user
            //Change role
            Yii::$app->authManager->revokeAll($this->id);
            $userRole = Yii::$app->authManager->getRole($this->role);
            Yii::$app->authManager->assign($userRole, $this->id);
        }

    }

    #*/
}
