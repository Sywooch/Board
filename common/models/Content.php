<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $page
 * @property integer $position
 */
class Content extends \yii\db\ActiveRecord
{
    const PAGE_ABOUT = 1;
    const POS_MAIN = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'page', 'position'], 'required'],
            [['text'], 'string'],
            [['page', 'position'], 'integer'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'page' => 'Page',
            'position' => 'Position',
        ];
    }
}
