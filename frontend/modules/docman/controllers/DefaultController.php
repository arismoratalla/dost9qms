<?php

namespace frontend\modules\docman\controllers;
use common\models\docman\Document;

use yii\web\Controller;

/**
 * Default controller for the `Budget` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDashboard()
    {
        $qm = Document::find()->where('qms_type_id =:qms_type_id AND category_id =:category_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id'], ':category_id'=>1])->count();
        $op = Document::find()->where('qms_type_id =:qms_type_id AND category_id =:category_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id'], ':category_id'=>2])->count();
        $wi = Document::find()->where('qms_type_id =:qms_type_id AND category_id =:category_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id'], ':category_id'=>3])->count();
        $methods = Document::find()->where('qms_type_id =:qms_type_id AND category_id =:category_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id'], ':category_id'=>5])->count();

        return $this->render('dashboard', [
            'qm'=>$qm,
            'op'=>$op,
            'wi'=>$wi,
            'methods'=>$methods,
        ]);
    }
}
