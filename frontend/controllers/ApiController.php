<?php

namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\system\Profile;

class ApiController extends ActiveController
{
    public $modelClass = 'common\models\system\Profile';
    //public function actionIndex()
    //{
    //    return $this->render('index');
    //}
    public function verbs() {
        parent::verbs();
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }
    public function actions() {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = function($action) {
            return new \yii\data\ActiveDataProvider([
                'query' => Profile::find()->where(['user_id' => Yii::$app->user->id]),
            ]);
        };

        return $actions;
    }
}
