<?php

namespace backend\controllers;

class SettingsController extends \yii\web\Controller
{
    public function actionEnable()
    {
        \Yii::$app->maintenanceMode->enable();
        return "System is in Maintenance Mode.";
    }
    public function actionDisable()
    {
        \Yii::$app->maintenanceMode->disable();
        return "System is Live now.";
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

}
