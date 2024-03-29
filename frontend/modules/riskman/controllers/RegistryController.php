<?php

namespace frontend\modules\riskman\controllers;

use Yii;
use kartik\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use common\models\riskman\Functionalunitgoalitem;
use common\models\riskman\Goal;
use common\models\riskman\Goalitem;
use common\models\riskman\Registry;
use common\models\riskman\Registryaction;
use common\models\riskman\Registryarea;
use common\models\riskman\Registryassessment;
use common\models\riskman\Registrymonitoring;
use common\models\riskman\RegistrySearch;
use common\models\riskman\Registrysource;
use common\models\docman\Functionalunit;
use common\models\system\Notification;
use common\models\system\Profile;
/**
 * RegistryController implements the CRUD actions for Registry model.
 */
class RegistryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    function actionMonitoring()
    {
        $searchModel = new RegistrySearch();
        $searchModel->registry_type = $_GET['registry_type'];
        $searchModel->status_id = 20;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $year = $_GET['year'];

        $paramsHeader = [];
        if($_GET['registry_type'] == 'Risk'){
            $paramsHeader['bg-color'] = 'background-color: #F39C12;';
            $paramsHeader['font-color'] = 'color: #000000;';
        }

        if($_GET['registry_type'] == 'Opportunity'){
            $paramsHeader['bg-color'] = 'background-color: #339900;';
            $paramsHeader['font-color'] = 'color: #ffffff;';
        }

        $paramsContent = 'white-space:nowrap;text-overflow: ellipsis;overflow:hidden;';
        
        $registry_types = '';

        $registry_types .= Html::a('RISKS', ['monitoring?registry_type=Risk&year='.$year], 
                                // 'index?registry_type=Risk&DocumentSearch[category_id]='.$category->category_id], [
                                [
                                    'class' => 'btn btn-warning',
                                    'data-pjax' => 0,
                                ]
                            );
        $registry_types .= ' ';
        $registry_types .= Html::a('OPPORTUNITIES', ['monitoring?registry_type=Opportunity&year='.$year], 
                            [
                                'class' => 'btn btn-success',
                                'data-pjax' => 0,
                            ]
                        );

        $toolbars = '';
        $units = Functionalunit::find()
            ->where([ 'in', 'functional_unit_id', explode(',',Yii::$app->user->identity->profile->groups) ])
            ->all();

        foreach($units as $unit){
            $toolbars .= Html::a($unit->code, ['monitoring?registry_type='.$_GET['registry_type'].'&year='.$_GET['year'].'&RegistrySearch[unit_id]='.$unit->functional_unit_id], [
                'class' => 'btn btn-outline-secondary',
                // 'style' => $color[$unit->functional_unit_id]. ' font-weight: bold;',
                'style' => 'color: #B76E79; font-weight: bold;',
                'data-pjax' => 0, 
            ]);
        }

        return $this->render('monitoring', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'registry_types' => $registry_types,
            'paramsHeader' => $paramsHeader,
            'paramsContent' => $paramsContent,
            'toolbars' => $toolbars,
        ]);
    }

    /**
     * Lists all Registry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegistrySearch();
        $searchModel->registry_type = $_GET['registry_type'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $year = $_GET['year'];

        $paramsHeader = [];
        if($_GET['registry_type'] == 'Risk'){
            $paramsHeader['bg-color'] = 'background-color: #F39C12;';
            $paramsHeader['font-color'] = 'color: #000000;';
        }

        if($_GET['registry_type'] == 'Opportunity'){
            $paramsHeader['bg-color'] = 'background-color: #339900;';
            $paramsHeader['font-color'] = 'color: #ffffff;';
        }

        $paramsContent = 'white-space:nowrap;text-overflow: ellipsis;overflow:hidden;';
        
        $registry_types = '';

        $registry_types .= Html::a('RISKS', ['index?registry_type=Risk&year='.$year], 
                                [
                                    'class' => 'btn btn-warning',
                                    'data-pjax' => 0,
                                ]
                            );
        $registry_types .= ' ';
        $registry_types .= Html::a('OPPORTUNITIES', ['index?registry_type=Opportunity&year='.$year], 
                            [
                                'class' => 'btn btn-success',
                                'data-pjax' => 0,
                            ]
                        );

        $toolbars = '';
        
        $units_filter = Functionalunit::find()
                ->where([ 'like', 'modules', 'riskman'])
                ->all();
        
        // $units = Functionalunit::find()->all();

        // $units = Functionalunit::find()
        //     ->where([ 'in', 'functional_unit_id', explode(',',Yii::$app->user->identity->profile->groups) ])
        //     ->all();


        foreach($units_filter as $unit){
            if(isset($_GET['RegistrySearch']['unit_id']))
                $underline = ( $_GET['RegistrySearch']['unit_id'] == $unit->functional_unit_id) ? 'text-decoration: underline; font-weight: bold; color: green;' : '';
            else
                $underline = '';

            $toolbars .= Html::a($unit->code, ['index?registry_type='.$_GET['registry_type'].'&year='.$_GET['year'].'&RegistrySearch[unit_id]='.$unit->functional_unit_id], [
                'class' => 'btn btn-outline-secondary',
                'style' => 'color: #B76E79; font-weight: bold; '.$underline,
                'data-pjax' => 0, 
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'registry_types' => $registry_types,
            'paramsHeader' => $paramsHeader,
            'paramsContent' => $paramsContent,
            'toolbars' => $toolbars,
            'units_filter' => $units_filter,
        ]);
    }

    public function actionDraft()
    {
        $searchModel = new RegistrySearch();
        $searchModel->status_id = 10;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $year = $_GET['year'];

        $paramsHeader = [];
        if(isset($_GET['registry_type'])){
            if($_GET['registry_type'] == 'Risk'){
                $paramsHeader['bg-color'] = 'background-color: #F39C12;';
                $paramsHeader['font-color'] = 'color: #000000;';
                $paramsContent['font-color'] = 'color: #F39C12;';
            }

            if($_GET['registry_type'] == 'Opportunity'){
                $paramsHeader['bg-color'] = 'background-color: #339900;';
                $paramsHeader['font-color'] = 'color: #ffffff;';
                $paramsContent['font-color'] = 'color: #339900;';
            }
        }

        $paramsContent['no-wrap'] = 'white-space:nowrap;text-overflow: ellipsis;overflow:hidden;';
        $paramsContent['Risk'] = '#F39C12';
        $paramsContent['Opportunity'] = '#339900';
        $buttons = '';

        $buttons .= Html::a('APPROVE ALL', ['approveall'], 
                                [
                                    'class' => 'btn btn-info',
                                    'data-pjax' => 0,
                                ]
                            );
        return $this->render('draft', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'buttons' => $buttons,
            'paramsHeader' => $paramsHeader,
            'paramsContent' => $paramsContent,
        ]);
    }

    /**
     * Displays a single Registry model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model,
            ]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }

        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new Registry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelRegistry = new Registry();
        $modelRegistrymonitoring = new Registrymonitoring();

        $disabled = (Yii::$app->controller->action->id == 'update') ? true : false;

        if(isset($_GET['registry_type']))
            $modelRegistry->registry_type = $_GET['registry_type'];

        $sources = ArrayHelper::map(Registrysource::find()->all(),'source_id','name');
        $areas = ArrayHelper::map(Registryarea::find()->all(),'area_id','name');

        if(isset($_GET['unit_id']))
            $modelRegistry->unit_id = $_GET['RegistrySearch']['unit_id'];

        if(Yii::$app->user->identity->username == 'Admin')
            $units = ArrayHelper::map(Functionalunit::find()->all(),'functional_unit_id','name');
        else{
            $groups = Profile::findOne(Yii::$app->user->identity->user_id)->groups;
            $units = ArrayHelper::map(Functionalunit::find()->where(['in', 'functional_unit_id', explode(',', $groups)])->all(),'functional_unit_id','name');
        }

        if ($modelRegistry->load(Yii::$app->request->post()) && $modelRegistrymonitoring->load(Yii::$app->request->post()) ) {
            $isValid = $modelRegistry->validate();
            $isValid = $modelRegistrymonitoring->validate() && $isValid;
            if ($isValid) {
                date_default_timezone_set('Asia/Manila');
                $modelRegistry->create_date = date("Y-m-d");
                $modelRegistry->created_by = Yii::$app->user->identity->user_id;
                if($modelRegistry->save(false)){
                    $modelRegistrymonitoring->registry_id = $modelRegistry->registry_id;
                    $modelRegistrymonitoring->save(false);

                    $funtional_unit = Functionalunit::findOne($modelRegistry->unit_id);

                    $notification = new Notification();
                    $notification->notification_type = Notification::TYPE_NOTIF;
                    $notification->notification_scope = Notification::SCOPE_APPROVE;
                    $notification->message =    "Draft Registry submission by "
                                                .Profile::findOne(Yii::$app->user->identity->user_id)->fullname
                                                ." for \r\n"
                                                .$funtional_unit->name
                                                .": \r\n"
                                                .$modelRegistry->registry_type
                                                ." - \r\n"
                                                .$modelRegistry->potential
                                                ;
                    $notification->group_id = $modelRegistry->unit_id;
                    $notification->user_id = $funtional_unit->unit_head;
                    $notification->sender_id = Yii::$app->user->identity->user_id;
                    $notification->save(false);

                    return $this->redirect(['registry/draft']);
                }
            }
                 
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'modelRegistry' => $modelRegistry,
                        'modelRegistrymonitoring' => $modelRegistrymonitoring,
                        'units' => $units,
                        'sources' => $sources,
                        'areas' => $areas,
                        'disabled' => $disabled,
            ]);
        } else {
            return $this->render('_form', [
                        'modelRegistry' => $modelRegistry,
                        'modelRegistrymonitoring' => $modelRegistrymonitoring,
                        'units' => $units,
                        'sources' => $sources,
                        'areas' => $areas,
                        'disabled' => $disabled,
            ]);
        }
        
    }

    public function actionApprove($id){

        $modelRegistry = Registry::findOne($id);

        $modelRegistrymonitoring = Registrymonitoring::find()->where(
            'registry_id =:registry_id',
            [
                ':registry_id' => $modelRegistry->registry_id,
            ])
            ->one();

        // $modelRegistry->registry_type = $_GET['registry_type'];
        $disabled = false;

        $sources = ArrayHelper::map(Registrysource::find()->all(),'source_id','name');
        $areas = ArrayHelper::map(Registryarea::find()->all(),'area_id','name');

        if(isset($_GET['unit_id']))
            $modelRegistry->unit_id = $_GET['RegistrySearch']['unit_id'];

        if(Yii::$app->user->identity->username == 'Admin')
            $units = ArrayHelper::map(Functionalunit::find()->all(),'functional_unit_id','name');
        else{
            $groups = Profile::findOne(Yii::$app->user->identity->user_id)->groups;
            $units = ArrayHelper::map(Functionalunit::find()->where(['in', 'functional_unit_id', explode(',', $groups)])->all(),'functional_unit_id','name');
        }

        if ($modelRegistry->load(Yii::$app->request->post()) && $modelRegistrymonitoring->load(Yii::$app->request->post()) ) {
            $isValid = $modelRegistry->validate();
            $isValid = $modelRegistrymonitoring->validate() && $isValid;
            if ($isValid) {
                date_default_timezone_set('Asia/Manila');
                $modelRegistry->code = $this->generateRegistryCode($modelRegistry->source_id, $modelRegistry->unit_id);
                $modelRegistry->approved_date = date("Y-m-d H:i:s");
                $modelRegistry->status_id = 20;

                if($modelRegistry->save(false));{
                    
                    $modelRegistrymonitoring->registry_id = $modelRegistry->registry_id;

                    if($modelRegistrymonitoring->save(false)){

                        $this->countRegistries($modelRegistry);

                        for($i=1; $i<=4; $i++){
                            $modelRegistryAssessment = new Registryassessment();
                            $modelRegistryAssessment->registry_id = $modelRegistry->registry_id;
                            $modelRegistryAssessment->likelihood_id = 0;
                            $modelRegistryAssessment->benefit_consequence_id = 0;
                            $modelRegistryAssessment->cause = '';
                            $modelRegistryAssessment->effect = '';
                            $modelRegistryAssessment->remarks = '';
                            $modelRegistryAssessment->evaluation = 0;
                            $modelRegistryAssessment->qtr = $i;
                            $modelRegistryAssessment->year = date("Y");
                            $modelRegistryAssessment->save(false);

                            $modelRegistryAction = new Registryaction();
                            $modelRegistryAction->registry_id = $modelRegistry->registry_id;
                            $modelRegistryAction->preventive_control_initiatives = '';
                            $modelRegistryAction->corrective_additional_action = '';
                            $modelRegistryAction->target_date_of_completion = date("Y-m-d");
                            $modelRegistryAction->qtr = $i;
                            $modelRegistryAction->year = date("Y");
                            $modelRegistryAction->save(false);
                        }

                        $notification = new Notification();
                        $notification->notification_type = Notification::TYPE_NOTIF;
                        $notification->notification_scope = Notification::SCOPE_APPROVE;
                        $notification->message =    "Your Registry submission has been APPROVED and assigned code: "
                                                    .$modelRegistry->code.'.'
                                                    ;
                        $notification->group_id = $modelRegistry->unit_id;
                        $notification->user_id = $modelRegistry->created_by;
                        $notification->sender_id = Yii::$app->user->identity->user_id;
                        $notification->save(false);

                        // Yii::$app->Notification->sendEmail(
                        //     '',                                     // $hash
                        //     Yii::$app->user->identity->user_id,      // $sender
                        //     Profile::findOne($modelRegistry->created_by)->email,                      // $recipient
                        //     'Risk and Opportunity Management App',  // $title
                        //     'Your Registry submission has been approve',  // $message
                        //     'Document Management System',           // $via
                        //     '',                      // $module
                        // '');

                        return $this->redirect(['registry/draft']);
                    }
                    
                }
            }
                 
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'modelRegistry' => $modelRegistry,
                        'modelRegistrymonitoring' => $modelRegistrymonitoring,
                        'units' => $units,
                        'sources' => $sources,
                        'areas' => $areas,
                        'disabled' => $disabled,
            ]);
        } else {
            return $this->render('_form', [
                        'modelRegistry' => $modelRegistry,
                        'modelRegistrymonitoring' => $modelRegistrymonitoring,
                        'units' => $units,
                        'sources' => $sources,
                        'areas' => $areas,
                        'disabled' => $disabled,
            ]);
        }
    }

    /**
     * Updates an existing Registry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sources = ArrayHelper::map(Registrysource::find()->all(),'source_id','name');
        $areas = ArrayHelper::map(Registryarea::find()->all(),'area_id','name');

        if(Yii::$app->user->identity->username == 'Admin')
            $units = ArrayHelper::map(Functionalunit::find()->all(),'functional_unit_id','name');
        else{
            $groups = Profile::findOne(Yii::$app->user->identity->user_id)->groups;
            $units = ArrayHelper::map(Functionalunit::find()->where(['in', 'functional_unit_id', explode(',', $groups)])->all(),'functional_unit_id','name');
        }

        $modelRegistrymonitoring = Registrymonitoring::find()->where(
            'registry_id =:registry_id',
            [
                ':registry_id' => $model->registry_id,
            ])
            ->one();
            
        $disabled = (Yii::$app->controller->action->id == 'update') ? true : false;

        if ($model->load(Yii::$app->request->post()) && $modelRegistrymonitoring->load(Yii::$app->request->post()) ) {
            $isValid = $model->validate();
            $isValid = $modelRegistrymonitoring->validate() && $isValid;
            if ($isValid) {
                if($model->save(false)){
                    $modelRegistrymonitoring->registry_id = $model->registry_id;
                    $modelRegistrymonitoring->save(false);

                    // $funtional_unit = Functionalunit::findOne($modelRegistry->unit_id);

                    // $notification = new Notification();
                    // $notification->notification_type = Notification::TYPE_NOTIF;
                    // $notification->notification_scope = Notification::SCOPE_REVIEW;
                    // $notification->message =    "Your Registry has been updated ".$model->code." by \r\n"
                    //                             .Profile::findOne(Yii::$app->user->identity->user_id)->fullname;
                    // $notification->group_id = $model->unit_id;
                    // $notification->user_id = $$model->created_by;
                    // $notification->sender_id = Yii::$app->user->identity->user_id;
                    // $notification->save(false);

                    return $this->redirect(['registry/index', 'registry_type'=>$model->registry_type, 'year'=>date('Y', strtotime($model->approved_date))]);
                }
            }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['index', 'registry_type'=>$_GET['registry_type'], 'year'=>$_GET['year']]);
        } else {
            return $this->renderAjax('_form', [
                'modelRegistry' => $model,
                'modelRegistrymonitoring' => $modelRegistrymonitoring,
                'units' => $units,
                'sources' => $sources,
                'areas' => $areas,
                'disabled' => $disabled, 
            ]);
        }
    }

    /**
     * Deletes an existing Registry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['draft']);
    }

    /**
     * Finds the Registry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Registry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Registry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function generateRegistryCode($source_id, $unit_id){
        $source = Registrysource::findOne($source_id);
        $unit = Functionalunit::findOne($unit_id);
        $year = date("Y");
        $month = date("m");
        $count = Registry::find()->where(['YEAR(`approved_date`)' => $year, 'unit_id'=>$unit_id, 'status_id'=>20])->orderBy(['approved_date' => SORT_DESC])->count();
        $count += 1;

        return $year.'-'.$month.'-'.$unit->code.'-'.$source->code.'-'.str_pad($count, 2, '0', STR_PAD_LEFT);
    }

    private function countRegistries($registry){

        date_default_timezone_set('Asia/Manila');
        $unit_goal = Functionalunitgoalitem::find()
            ->where(['goal_item_id' => 15])
            ->andWhere(['unit_id' => $registry->unit_id])
            ->one();

        if($unit_goal){
            $count = $unit_goal->count + 1;
            $unit_goal->count = $count;
            if($count == $unit_goal->target)
                $unit_goal->date_achieved = date("Y-m-d H:i:s");

            $unit_goal->save(false);
        }else{
            $unit_goal = new Functionalunitgoalitem();
            $unit_goal->goal_item_id = 15;
            $unit_goal->unit_id = $registry->unit_id;
            $unit_goal->count = 1;
            $unit_goal->target = Goalitem::findOne(15)->goal_target;
            $unit_goal->save(false);
        }
    }
}
