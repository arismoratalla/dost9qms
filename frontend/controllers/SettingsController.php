<?php

namespace frontend\controllers;
use Yii;
class SettingsController extends \yii\web\Controller
{
    public function actionEnable()
    {
        Yii::$app->maintenanceMode->enable();
        return 'System is now on Maintenance Mode';
    }
    public function actionDisable()
    {
        Yii::$app->maintenanceMode->disable();
        return "System is Live now.";
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

}
