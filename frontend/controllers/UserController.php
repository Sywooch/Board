<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 12.03.16
 * Time: 9:36
 */

namespace frontend\controllers;

use common\models\Object;
use common\models\Propeties;
use common\models\Type;
use common\models\User;
use Yii;
use common\models\Board;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;

/**
 * BoardController implements the CRUD actions for Board model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['cabinet', 'check-email' ,'update'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays cabinet page.
     *
     * @return mixed
     */
    public function actionCabinet()
    {
        $model = $this->findModel(Yii::$app->user->id);


            return $this->render('cabinet', [
                'model' => $model,
            ]);

    }

    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            $old = $model->oldAttributes;
            if ($old['email'] != $model->email)
            {
                $model->valid_token = $model->generateValidToken();
                $model->sendValid_email();
            }
            if ($model->save())
                return $this->redirect(['cabinet']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionCheckEmail($token)
    {
        $model = $this->findModel(Yii::$app->user->id);
        if ($model->checkEmail($token))
        {
            $model->save();
            Yii::$app->session->setFlash('success', '<h2 class="text-center">Ваш E-mail успешно подтвержден.</h2>');

            return $this->goHome();
        }
        else
        {
            Yii::$app->session->setFlash('error', '<h2 class="text-center">Токен не верный, попробуйте еще раз.</h2>');

            return $this->goHome();
        }

    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Board the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}