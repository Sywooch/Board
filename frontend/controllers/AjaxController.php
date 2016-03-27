<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 01.03.16
 * Time: 18:17
 */

namespace frontend\controllers;

use common\models\Board;
use Yii;
use yii\helpers\Json;
use common\models\Propeties;
use yii\web\Controller;


class AjaxController extends Controller {



    /*
     * JSON array of property Ads
     */
    public function actionGetpropeties()
    {
        if (Yii::$app->request->isAjax) {
            $id_obj = Yii::$app->getRequest()->getQueryParam('id_object');
            $id_type = Yii::$app->getRequest()->getQueryParam('id_type');
            $propeties = Propeties::findAll(['id_object' => $id_obj, 'id_type' => $id_type]);
            $result = [];
            foreach ($propeties as $prop)
            {
                if ($prop->val)
                    $arr = explode(',', $prop->val);
                else
                    $arr = false;

                $result[] = array('id' => $prop['id'], 'name' => $prop['name'], 'val' => $arr);
            }
            echo Json::encode($result);
        }
    }

    public function actionGetphone($id)
    {
        if (Yii::$app->request->isAjax) {
            $model = Board::findOne($id);
            $model->updateCounters(['views' => 1]);
            $result = ['phone' => $model->idUser->phone];
            echo Json::encode($result);
        }
    }
}