<?php

namespace frontend\modules\riskman\controllers;
use common\models\riskman\Registry;

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
        $risks = Registry::find()->where('registry_type =:registry_type AND YEAR(`create_date`) =:year AND status_id =20',[':registry_type'=>'Risk', ':year'=>$_GET['year']])->count();
        $opportunities = Registry::find()->where('registry_type =:registry_type AND YEAR(`create_date`) =:year AND status_id =20',[':registry_type'=>'Opportunity', ':year'=>$_GET['year']])->count();

        return $this->render('dashboard', [
            'risks'=>$risks,
            'opportunities'=>$opportunities,
        ]);
    }
}
