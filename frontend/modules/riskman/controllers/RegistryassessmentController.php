<?php

namespace frontend\modules\riskman\controllers;

use Yii;

use kartik\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use common\models\riskman\Benefitscale;
use common\models\riskman\Consequencescale;
use common\models\riskman\Likelihoodscale;
use common\models\riskman\Registry;
use common\models\riskman\Registryaction;
use common\models\riskman\Registryassessment;
use common\models\riskman\RegistryassessmentSearch;

use common\models\riskman\Registrymonitoring;
use common\models\riskman\RegistrySearch;
use common\models\docman\Functionalunit;
use common\models\system\Profile;
/**
 * RegistryassessmentController implements the CRUD actions for Registryassessment model.
 */
class RegistryassessmentController extends Controller
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

    /**
     * Lists all Registryassessment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegistryassessmentSearch();
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
            23 => 'color: #B76E79',
            24 => 'color: #B76E79',
            25 => 'color: #B76E79',
            26 => 'color: #B76E79',
            27 => 'color: #B76E79',
            28 => 'color: #B76E79',
            29 => 'color: #B76E79',
            30 => 'color: #B76E79',
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
                'style' => $color[$unit->functional_unit_id]. ' font-weight: bold;',
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
     * Displays a single Registryassessment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Registryassessment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Registryassessment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->registry_assessment]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/
    public function actionCreate()
    {
        $modelAssessment = new Registryassessment();
        $modelAction = new Registryaction();

        $registry = Registry::findOne($_GET['registry_id']);
        $registry_type = $_GET['registry_type'];
        
        $modelAssessment->registry_id = $_GET['registry_id'];
        $modelAssessment->qtr = ceil( date("n")/3 );
        $modelAssessment->year = date("Y");

        $modelAction->registry_id = $_GET['registry_id'];
        $modelAction->qtr = ceil( date("n")/3 );
        $modelAction->year = date("Y");

            $likelihood = ArrayHelper::map(Likelihoodscale::find()->all(),'likelihood_id','scale');
            $benefit = ArrayHelper::map(Benefitscale::find()->all(),'benefit_id','scale');
            $consequence = ArrayHelper::map(Consequencescale::find()->all(),'consequence_id','scale');

            if($registry_type == "Risk")
                $benefit_consequence = $consequence;
            elseif(($registry_type == "Opportunity"))
                $benefit_consequence = $benefit;
                
            //$groups = Profile::findOne(Yii::$app->user->identity->user_id)->groups;
            //$units = ArrayHelper::map(Functionalunit::find()->where(['in', 'functional_unit_id', [groups]])->all(),'functional_unit_id','name');


        if ( $modelAssessment->load(Yii::$app->request->post()) && $modelAction->load(Yii::$app->request->post()) ) {
            $isValid = $modelAssessment->validate();
            $isValid = $modelAction->validate() && $isValid;
            if ($isValid) {
                $modelAssessment->save(false);
                $modelAction->save(false);
                return $this->redirect(['/riskman/registry/index','registry_type'=>$_GET['registry_type'], 'year'=>$_GET['year']]);  
            }
            
            // if($modelAssessment->save(false)){
            //     return $this->redirect(['/riskman/registry/index','registry_type'=>$_GET['registry_type'], 'year'=>$_GET['year']]);   
            // }
                 
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'modelAssessment' => $modelAssessment,
                        'modelAction' => $modelAction,
                        'likelihood' => $likelihood,
                        'benefit_consequence' => $benefit_consequence,
                        'registry' => $registry,
            ]);
        } else {
            return $this->render('_form', [
                        'modelAssessment' => $modelAssessment,
                        'modelAction' => $modelAction,
                        'likelihood' => $likelihood,
                        'benefit_consequence' => $benefit_consequence,
                        'registry' => $registry,
            ]);
        }
        
    }

    /**
     * Updates an existing Registryassessment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        // $model = $this->findModel($id);

        $modelAssessment = Registryassessment::findOne($id);

        // FIX THIS
        $modelAction = new Registryaction();
        $modelAction = Registryaction::find()->where(
            'registry_id =:registry_id AND qtr = :qtr AND year = :year',
            [
                ':registry_id' => $modelAssessment->registry_id,
                ':qtr' => $modelAssessment->qtr,
                ':year' => date("Y")
            ])
            ->one();
        // $modelAction = Registryaction::findOne($modelAssessment->registry_id);

        // $registry = Registry::findOne($_GET['registry_id']);
        $registry_type = $_GET['registry_type'];
        $modelAssessment->registry_id = $modelAssessment->registry_id;
        // $modelAssessment->qtr = ceil( date("n")/3 );
        $modelAssessment->year = date("Y");
        $modelAction->registry_id = $modelAssessment->registry_id;
        //$modelAction->qtr = ceil( date("n")/3 );
        // $modelAction->target_date_of_completion = date("Y-m-d", $_POST['Registryaction']['target_date_of_completion']);
        $modelAction->year = date("Y");

        $likelihood = ArrayHelper::map(Likelihoodscale::find()->all(),'likelihood_id','scale');
        $benefit = ArrayHelper::map(Benefitscale::find()->all(),'benefit_id','scale');
        $consequence = ArrayHelper::map(Consequencescale::find()->all(),'consequence_id','scale');

        if($registry_type == "Risk")
            $benefit_consequence = $consequence;
        elseif(($registry_type == "Opportunity"))
            $benefit_consequence = $benefit;

        if ( $modelAssessment->load(Yii::$app->request->post()) && $modelAction->load(Yii::$app->request->post()) ) {
            $isValid = $modelAssessment->validate();
            $isValid = $modelAction->validate() && $isValid;
            if ($isValid) {
                $modelAssessment->save(false);
                $modelAction->save(false);
                return $this->redirect(['registryassessment/index','registry_type'=>$_GET['registry_type'], 'year'=>$_GET['year']]);
            }
            
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('_form', [
                    'modelAssessment' => $modelAssessment,
                    'modelAction' => $modelAction,
                    'likelihood' => $likelihood,
                    'benefit_consequence' => $benefit_consequence,
                    // 'registry' => $registry,
                ]);
            } else {
                return $this->render('_form', [
                    'modelAssessment' => $modelAssessment,
                    'modelAction' => $modelAction,
                    'likelihood' => $likelihood,
                    'benefit_consequence' => $benefit_consequence,
                    // 'registry' => $registry,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Registryassessment model.
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
     * Finds the Registryassessment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Registryassessment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Registryassessment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
