<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 01.03.16
 * Time: 18:17
 */

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use common\models\Propeties;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class AjaxController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['getpropeties',],
                        'allow' => true,
                        'roles' => ['admin'],
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

    /*
     * JSON array of property Ads
     */
    public function actionGetpropeties()
    {
        if (Yii::$app->request->isAjax) {
            $id_obj = Yii::$app->getRequest()->getQueryParam('id');
            $propeties = Propeties::findAll(['id_objects' => $id_obj]);
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
}