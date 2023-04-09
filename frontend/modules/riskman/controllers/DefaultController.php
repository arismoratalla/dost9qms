<?php

namespace frontend\modules\riskman\controllers;
use Yii;
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
        //$query->andFilterWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)]);

        $drafts = Registry::find()
            ->where([ 'status_id'=> 10 ])
            // ->andWhere([ 'registry_type'=> 'Risk' ])
            // ->where('registry_type =:registry_type AND YEAR(`create_date`) =:year AND status_id =20',
                // [':registry_type'=>'Risk', ':year'=>$_GET['year']])
            ->andWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)])
            ->count();

        $risks = Registry::find()
            ->where([ 'status_id'=> 20 ])
            ->andWhere([ 'registry_type'=> 'Risk' ])
            // ->where('registry_type =:registry_type AND YEAR(`create_date`) =:year AND status_id =20',
                // [':registry_type'=>'Risk', ':year'=>$_GET['year']])
            ->andWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)])
            ->count();

        $opportunities = Registry::find()
            ->where([ 'status_id'=> 20 ])
            ->andWhere([ 'registry_type'=> 'Risk' ])
            ->andWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)])
            ->count();

        //Yii::$app->Notification->sendEmail('', 2, 'arismoratalla@gmail.com', 'Dashboard', 'Test Email', 'DMS', $this->module->id, $this->action->id);
        // Yii::$app->Notification->sendSMS('', 2, $recipient->primary->sms, 'Request for Obligation', $content, 'FAIMS', $this->module->id, $this->action->id);

        return $this->render('dashboard', [
            'risks'=>$risks,
            'opportunities'=>$opportunities,
            'drafts'=>$drafts,
        ]);
    }
}
