<?php

namespace frontend\modules\riskman\controllers;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kartik\helpers\Html;
use yii\web\Controller;
use yii\web\JsExpression;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\docman\Functionalunit;
use common\models\riskman\Functionalunitgoalitem;
use common\models\riskman\Registry;

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
        

        $toolbars = Html::a('ALL', ['dashboard?year='.$_GET['year']], [
            'class' => 'text-muted small',
            'style' => 'color: #0A1172; font-weight: bold;',
            'data-pjax' => 0, 
        ]);

        if(Yii::$app->user->can('riskman-manager') || (Yii::$app->user->identity->username == 'Admin')){
            $units = Functionalunit::find()
                ->where([ 'like', 'modules', 'riskman'])
                ->all();
        }else{
            $units = Functionalunit::find()
                //->where([ 'in', 'functional_unit_id', explode(',',Yii::$app->user->identity->profile->groups) ])
                ->where([ 'like', 'modules', 'riskman'])
                ->all();
        }
        
        foreach($units as $unit){
            if(isset($_GET['unit_id']))
                $underline = ( $_GET['unit_id'] == $unit->functional_unit_id) ? 'text-decoration: underline; font-size: 1em; color: green;' : '';
            else
                $underline = '';

            $toolbars .= Html::a($unit->code, ['dashboard?unit_id='.$unit->functional_unit_id.'&year='.$_GET['year']], [
                'class' => 'text-muted small',
                'style' => 'color: #0A1172; font-weight: bold; '.$underline,
                'data-pjax' => 0, 
            ]);
        }

        if(isset($_GET['unit_id'])){
            $unit_id = $_GET['unit_id'];

            $drafts = Registry::find()
                ->where([ 'status_id'=> 10 ])
                ->andWhere([ 'registry_type'=> 'Risk' ])
                ->andWhere([ 'unit_id'=> $unit_id ])
                // ->where('registry_type =:registry_type AND YEAR(`create_date`) =:year AND status_id =20',
                    // [':registry_type'=>'Risk', ':year'=>$_GET['year']])
                // ->andWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)])
                ->count();

            $risks = Registry::find()
                ->where([ 'status_id'=> 20 ])
                ->andWhere([ 'registry_type'=> 'Risk' ])
                ->andWhere([ 'unit_id'=> $unit_id ])
                // ->where('registry_type =:registry_type AND YEAR(`create_date`) =:year AND status_id =20',
                    // [':registry_type'=>'Risk', ':year'=>$_GET['year']])
                // ->andWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)])
                ->count();

            $pieRisks = Registry::find()
                ->with(['area'])
                ->select('area_id, count(*) as count')
                ->groupBy('area_id')
                ->where([ 'status_id'=> 20 ])
                ->andWhere([ 'registry_type'=> 'Risk' ])
                ->andWhere([ 'unit_id'=> $unit_id ])
                ->asArray()->all();

            $opportunities = Registry::find()
                ->where([ 'status_id'=> 20 ])
                ->andWhere([ 'registry_type'=> 'Opportunity' ])
                ->andWhere([ 'unit_id'=> $unit_id ])
                // ->andWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)])
                ->count();

            $pieOpportunities = Registry::find()
                ->with(['area'])
                ->select('area_id, count(*) as count')
                ->groupBy('area_id')
                ->where([ 'status_id'=> 20 ])
                ->andWhere([ 'registry_type'=> 'Opportunity' ])
                ->andWhere([ 'unit_id'=> $unit_id ])
                ->asArray()->all();
        }else{
            $drafts = Registry::find()
                ->where([ 'status_id'=> 10 ])
                ->andWhere([ 'registry_type'=> 'Risk' ])
                // ->where('registry_type =:registry_type AND YEAR(`create_date`) =:year AND status_id =20',
                    // [':registry_type'=>'Risk', ':year'=>$_GET['year']])
                // ->andWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)])
                ->count();

            $risks = Registry::find()
                ->where([ 'status_id'=> 20 ])
                ->andWhere([ 'registry_type'=> 'Risk' ])
                // ->where('registry_type =:registry_type AND YEAR(`create_date`) =:year AND status_id =20',
                    // [':registry_type'=>'Risk', ':year'=>$_GET['year']])
                // ->andWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)])
                ->count();

            $pieRisks = Registry::find()
                ->with(['area'])
                ->select('area_id, count(*) as count')
                ->groupBy('area_id')
                ->where([ 'status_id'=> 20 ])
                ->andWhere([ 'registry_type'=> 'Risk' ])
                // ->andWhere([ 'unit_id'=> $unit_id ])
                ->asArray()->all();

            $opportunities = Registry::find()
                ->where([ 'status_id'=> 20 ])
                ->andWhere([ 'registry_type'=> 'Opportunity' ])
                // ->andWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)])
                ->count();
            
            $pieOpportunities = Registry::find()
                ->with(['area'])
                ->select('area_id, count(*) as count')
                ->groupBy('area_id')
                ->where([ 'status_id'=> 20 ])
                ->andWhere([ 'registry_type'=> 'Opportunity' ])
                // ->andWhere([ 'unit_id'=> $unit_id ])
                ->asArray()->all();
        }
        
        // $pieRisk = [];
        // $pieOpportunity = [];

        for($i=0; $i<count($pieRisks); $i++){
            $pieRisks[$i] = [
                'name' => (String)$pieRisks[$i]['area']['name'],
                'y' => (int)$pieRisks[$i]['count'],
                'color' => new JsExpression('Highcharts.getOptions().colors['.$i.']'), 
            ];
        }
        
        for($i=0; $i<count($pieOpportunities); $i++){
            $pieOpportunities[$i] = [
                'name' => (String)$pieOpportunities[$i]['area']['name'],
                'y' => (int)$pieOpportunities[$i]['count'],
                'color' => new JsExpression('Highcharts.getOptions().colors['.$i.']'), 
            ];
        }

        $timelinessCompleteness = new ActiveDataProvider([
            'query' => Functionalunitgoalitem::find(),
            'sort'=> ['defaultOrder' => ['date_achieved'=>SORT_ASC]]
        ]);

        return $this->render('dashboard', [
            'risks'=>$risks,
            'opportunities'=>$opportunities,
            'drafts'=>$drafts,
            'toolbars'=>$toolbars,
            'pieRisks'=>$pieRisks,
            'pieOpportunities'=>$pieOpportunities,
            'timelinessCompleteness'=>$timelinessCompleteness,
        ]);
    }

    public function actionAwards()
    {
        $timelinessCompleteness = new ActiveDataProvider([
            'query' => Functionalunitgoalitem::find(),
            'sort'=> ['defaultOrder' => ['date_achieved'=>SORT_ASC]]
        ]);

        return $this->render('awards', [
            'timelinessCompleteness' => $timelinessCompleteness
        ]);
    }

    public function actionCharts()
    {
        return $this->render('charts', [
        ]);
    }
}
