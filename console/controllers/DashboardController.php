<?php

namespace console\controllers;

// namespace app\commands;
use Yii;
use yii\console\Controller;
use common\models\finance\Request;
use common\models\apiservice\Notificationrecipient;
//use yii\base\ErrorException;
/**
 * This is an example...


**/

class DashboardController extends Controller
{

 	public function actionIndex()
    {
        echo 'Dashboard Index.';
    }
    
    public function actionDaily()
    {
        $forVerification = Request::find()->where('status_id =:status_id',[':status_id'=>Request::STATUS_SUBMITTED])->count();
        $forValidationFASS = Request::find()->where('division_id =:division_id AND status_id =:status_id',[':division_id'=>, ':status_id'=>Request::STATUS_VERIFIED])->count();
        $forValidationFOS = Request::find()->where('division_id =:division_id status_id =:status_id',[':status_id'=>Request::STATUS_VERIFIED])->count();
        $forAllotment = Request::find()->where('status_id =:status_id',[':status_id'=>Request::STATUS_VALIDATED])->count();
        $forObligation = Request::find()->where('status_id =:status_id',[':status_id'=>Request::STATUS_CERTIFIED_ALLOTMENT_AVAILABLE])->count();
        $forCharging = Request::find()->where('status_id =:status_id',[':status_id'=>Request::STATUS_ALLOTTED])->count();
        $forDisbursement = Request::find()->where('status_id =:status_id',[':status_id'=>Request::STATUS_CERTIFIED_FUNDS_AVAILABLE])->count();
        $forApproval = Request::find()->where('status_id =:status_id',[':status_id'=>Request::STATUS_CHARGED])->count();
        $forPayment = Request::find()->where('status_id =:status_id',[':status_id'=>Request::STATUS_APPROVED_FOR_DISBURSEMENT])->count();
        
        $dashboard = [
            '0' => [
                'status_id' => Request::STATUS_SUBMITTED,
                'title' => 'Request for Verification',
                'count' => $forVerification,
            ],
            '1' => [
                'status_id' => Request::STATUS_VERIFIED,
                'title' => 'Request for Validation',
                'count' => $forValidation,
            ],
            '2' => [
                'status_id' => Request::STATUS_VERIFIED,
                'title' => 'Request for Validation',
                'count' => $forAllotment,
            ],
            '3' => [
                'status_id' => Request::STATUS_VERIFIED,
                'title' => 'Request for Validation',
                'count' => $forObligation,
            ],
            '4' => [
                'status_id' => Request::STATUS_VERIFIED,
                'title' => 'Request for Validation',
                'count' => $forCharging,
            ],
            '5' => [
                'status_id' => Request::STATUS_VERIFIED,
                'title' => 'Request for Validation',
                'count' => $forDisbursement,
            ],
            '6' => [
                'status_id' => Request::STATUS_VERIFIED,
                'title' => 'Request for Validation',
                'count' => $forApproval,
            ],
            '7' => [
                'status_id' => Request::STATUS_VERIFIED,
                'title' => 'Request for Validation',
                'count' => $forPayment,
            ],
        ];
        
        $content = 'Good day!'.PHP_EOL.PHP_EOL;
        $content .= 'You have '.$forVerification.' Requests waiting for Verification.';
        //$content .= 'Amount: '.$model->amount.PHP_EOL.PHP_EOL;
        //$content .= 'Particulars: '.PHP_EOL.$model->particulars;
        
        //$recipient = Notificationrecipient::find()->where(['status_id' => $model->status_id])->one();
        
        //$recipient->primary->sms.','.$recipient->secondary->sms
        Yii::$app->Notification->sendSMS('', 2, '639177975944', 'Request for Verification', $content, 'FAIMS', $this->module->id, $this->action->id);
                    
        //Yii::$app->Notification->sendEmail('', 2, $recipient->primary->email.','.$recipient->secondary->email, 'Request for Verification', $content, 'FAIMS', $this->module->id, $this->action->id);
    }

}