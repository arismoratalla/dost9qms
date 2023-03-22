<?php

namespace frontend\modules\riskman\controllers;

use Yii;
use kartik\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use common\models\riskman\Registry;
use common\models\riskman\Registryaction;
use common\models\riskman\Registryassessment;
use common\models\riskman\Registrymonitoring;
use common\models\riskman\RegistrySearch;
use common\models\docman\Functionalunit;
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

        $color = [
            1 => 'color: #B76E79',
            2 => 'color: #B76E79',
            3 => 'color: #B76E79',
            4 => 'color: #B76E79',
            5 => 'color: #B76E79',
            6 => 'color: #B76E79',
            7 => 'color: #B76E79',
            8 => 'color: #B76E79',
            9 => 'color: #B76E79',
            10 => 'color: #B76E79',
            11 => 'color: #B76E79',
            12 => 'color: #B76E79',
            13 => 'color: #B76E79',
            14 => 'color: #B76E79',
            15 => 'color: #B76E79',
            16 => 'color: #B76E79',
            17 => 'color: #B76E79',
            18 => 'color: #8A9A5B',
            19 => 'color: #00FFFF',
            20 => 'color: #B76E79',
            21 => 'color: #B76E79',
            22 => 'color: #B76E79',
        ];

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
                                // 'index?registry_type=Risk&DocumentSearch[category_id]='.$category->category_id], [
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
        $units = Functionalunit::find()
            ->where([ 'in', 'functional_unit_id', explode(',',Yii::$app->user->identity->profile->groups) ])
            ->all();

        foreach($units as $unit){
            $toolbars .= Html::a($unit->code, ['index?registry_type='.$_GET['registry_type'].'&year='.$_GET['year'].'&RegistrySearch[unit_id]='.$unit->functional_unit_id], [
                'class' => 'btn btn-outline-secondary',
                // 'style' => $color[$unit->functional_unit_id]. ' font-weight: bold;',
                'style' => 'color: #B76E79; font-weight: bold;',
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
        $modelRegistry->registry_type = $_GET['registry_type'];

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
                if($modelRegistry->save(false));{
                    $modelRegistrymonitoring->registry_id = $modelRegistry->registry_id;

                    if($modelRegistrymonitoring->save(false)){
                        for($i=1; $i<=4; $i++){
                            $modelRegistryAssessment = new Registryassessment();
                            $modelRegistryAssessment->registry_id = $modelRegistry->registry_id;
                            $modelRegistryAssessment->likelihood_id = 0;
                            $modelRegistryAssessment->benefit_consequence_id = 0;
                            $modelRegistryAssessment->cause = '';
                            $modelRegistryAssessment->effect = '';
                            $modelRegistryAssessment->evaluation = 0;
                            $modelRegistryAssessment->qtr = $i;
                            $modelRegistryAssessment->year = date("Y");
                            $modelRegistryAssessment->save(false);

                            $modelRegistryAction = new Registryaction();
                            $modelRegistryAction->registry_id = $modelRegistry->registry_id;
                            $modelRegistryAction->preventive_control_initiatives = '';
                            $modelRegistryAction->corrective_additional_action = '';
                            $modelRegistryAction->target_date_of_completion = '0000-00-00';
                            $modelRegistryAction->qtr = $i;
                            $modelRegistryAction->year = date("Y");
                            $modelRegistryAction->save(false);
                        }

                        return $this->redirect(['registryassessment/index','registry_type'=>$_GET['registry_type'], 'year'=>$_GET['year']]);
                    }
                        
                }
            }
                 
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'modelRegistry' => $modelRegistry,
                        'modelRegistrymonitoring' => $modelRegistrymonitoring,
                        'units' => $units,
            ]);
        } else {
            return $this->render('_form', [
                        'modelRegistry' => $modelRegistry,
                        'modelRegistrymonitoring' => $modelRegistrymonitoring,
                        'units' => $units,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->registry_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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

        return $this->redirect(['index']);
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
}
