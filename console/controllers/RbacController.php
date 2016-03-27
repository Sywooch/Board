<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 23.02.16
 * Time: 16:19
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;



class RbacController extends Controller
{
    public function actionInit()
    {

        $role = Yii::$app->authManager->createRole('admin');
        $role->description = 'Администратор';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('manager');
        $role->description = 'Менеджер';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('agency');
        $role->description = 'Агентство';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('user');
        $role->description = 'Пользователь';
        Yii::$app->authManager->add($role);

        // Implement
        $role_admin   = Yii::$app->authManager->getRole('admin');
        $role_manager = Yii::$app->authManager->getRole('manager');
        $role_agency  = Yii::$app->authManager->getRole('agency');
        $role_user    = Yii::$app->authManager->getRole('user');
        Yii::$app->authManager->addChild($role_admin, $role_manager);
        Yii::$app->authManager->addChild($role_manager, $role_agency);
        Yii::$app->authManager->addChild($role_agency, $role_user);
        /* */
    }
}