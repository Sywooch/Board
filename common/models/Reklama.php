<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%reklama}}".
 *
 * @property integer $id
 * @property integer $id_board
 * @property integer $page
 * @property integer $position
 * @property integer $weight
 */
class Reklama extends \yii\db\ActiveRecord
{
    const PAGE_INDEX = 1;
    const PAGE_RESULT = 2;
    const PAGE_VIEW = 3;

    const POS_LEFT = 1;
    const POS_RIGHT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reklama}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_board', 'page', 'position'], 'required'],
            [['id_board', 'page', 'position', 'weight'], 'integer'],
            ['weight', 'default', 'value' => 0],
            [['id_board'], 'exist', 'skipOnError' => true, 'targetClass' => Board::className(), 'targetAttribute' => ['id_board' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_board' => 'Объявление',
            'page' => 'Страница',
            'position' => 'Позиция',
            'weight' => 'Вес',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBoard()
    {
        return $this->hasOne(Board::className(), ['id' => 'id_board']);
    }

    /**
     * Список страниц
     * @return array
     */
    public function ListPages()
    {
        $marked = [self::PAGE_INDEX=>'На главной', self::PAGE_RESULT => 'В результатах поиска', self::PAGE_VIEW => 'В просмотре объявлений'];
        return $marked;
    }

    /**
     * Список позиций
     * @return array
     */
    public function ListPositions()
    {
        $marked = [self::POS_LEFT=>'Слева', self::POS_RIGHT => 'Справа',];
        return $marked;
    }
}
