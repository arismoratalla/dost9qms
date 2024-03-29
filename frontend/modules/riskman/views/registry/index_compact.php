<?php
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

use kartik\datecontrol\DateControl;
use kartik\detail\DetailView;
use kartik\editable\Editable; 
use kartik\export\ExportMenu;
use kartik\grid\GridView;

use yii\bootstrap\Modal;

use common\models\riskman\Benefitscale;
use common\models\riskman\Consequencescale;
use common\models\riskman\Likelihoodscale;
use common\models\riskman\Riskappetite;
use common\models\riskman\Opportunityappetite;
// use common\models\docman\Category;
// use common\models\docman\Document;

/* @var $this yii\web\View */
/* @var $searchModel common\models\finance\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registry';
$this->params['breadcrumbs'][] = $this->title;

// Modal Create Request
Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalRegistry',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();

// Modal Add Assessment
Modal::begin([
    'header' => '<h4 id="modalCreditorHeader" style="color: #ffffff"></h4>',
    'id' => 'modalAssessment',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();
?>

<div class="registry-index">

<?php Pjax::begin(); ?>
      <?php
        echo GridView::widget([
            'id' => 'request',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'responsive' => true,
            //'floatHeader' => true, // floats header to top
            //'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            // 'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            // 'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'tableOptions' => [
                'style' => 'table-layout: fixed;',
                // 'class' => 'table table-striped table-bordered',
            ],
            'columns' => [
                            [
                                'attribute'=>'registry_id',
                                'headerOptions' => ['style' => 'width: 3%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> '#',
                                'contentOptions' => ['style' => 'width: 3%; text-align: center; vertical-align: middle;'],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    if($model->assessment){
                                        return Html::button('<i class="fas fa-edit"></i>', 
                                            ['value' => Url::to(['registryassessment/update', 
                                                                'registry_id' => $model->registry_id, 
                                                                'registry_type' => $model->registry_type, 
                                                                'year' => $_GET['year'] ]), 
                                            'title' => 'Add Registry', 
                                            'class' => 'btn btn-info', 
                                            'style'=>'margin-right: 6px;', 'id'=>'buttonAddAssessment']);
                                    }else{
                                        return Html::button('<i class="fas fa-plus"></i>', 
                                            ['value' => Url::to(['registryassessment/create', 
                                                                'registry_id' => $model->registry_id, 
                                                                'registry_type' => $model->registry_type, 
                                                                'year' => $_GET['year'] ]), 
                                            'title' => 'Add Registry', 
                                            'class' => 'btn btn-info', 
                                            'style'=>'margin-right: 6px;', 'id'=>'buttonAddAssessment']);
                                    }
                                },
                            ],
                            [
                                'attribute'=>'code',
                                'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> $_GET['registry_type'].' Details',
                                'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                                'format'=>'html',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return  '<b>'.$model->code.'</b><br/>'.
                                            '<i>'.$model->stakeholders.'</i><br/>'.
                                            '<font color="blue"><b>'.$model->customer_requirement.'</b><br/>';
                                            // '<i>'.$model->potential.'</i>';
                                },
                            ],
                            [
                                'attribute'=>'previous_evaluation',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>'Previous Evaluation',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                            ],
                            [
                                'attribute'=>'assessment_id',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>'Likelihood',
                                'contentOptions' => ['style' => 'width: 68%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    // return $model->assessment->registry_assessment_id;
                                    $likelihood = "";
                                    foreach($model->assessment as $assessment){
                                        if($assessment->year == $_GET['year'])
                                            $likelihood = Likelihoodscale::findOne($assessment->likelihood_id)->scale;
                                    }
                                    return $likelihood;
                                    // return '<p class="data-toggle="tooltip" title="Disabled tooltip">'.$likelihood.'<p>';
                                },
                            ],
                            [
                                'attribute'=>'assessment_id',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>'Trigger',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    // return $model->assessment->registry_assessment_id;
                                    $cause = "";
                                    foreach($model->assessment as $assessment){
                                        if($assessment->year == $_GET['year'])
                                            $cause = $assessment->cause;
                                    }
                                    return $cause;
                                },
                            ],
                            [
                                'attribute'=>'assessment_id',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> ( ($_GET['registry_type'] == "Risk") ? "Benefit" : "Consequence"),
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    // return $model->assessment->registry_assessment_id;
                                    $benefit_consequence = "";
                                    foreach($model->assessment as $assessment){
                                        if($assessment->year == $_GET['year']){
                                            if($_GET['registry_type'] == "Risk"){
                                                $benefit_consequence = Consequencescale::findOne($assessment->benefit_consequence_id)->scale;
                                            }elseif($_GET['registry_type'] == "Opportunity"){
                                                $benefit_consequence = Benefitscale::findOne($assessment->benefit_consequence_id)->scale;
                                            }
                                        }
                                    }
                                    return $benefit_consequence;
                                },
                            ],
                            [
                                'attribute'=>'assessment_id',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>'Effects',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    // return $model->assessment->registry_assessment_id;
                                    $effects = "";
                                    foreach($model->assessment as $assessment){
                                        if($assessment->year == $_GET['year'])
                                            $effects = $assessment->effect;
                                    }
                                    return $effects;
                                },
                            ],
                            [
                                'attribute'=>'evaluation_id',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>'Evaluation',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) {
                                    if($model->assessment){
                                        $evaluation = "";
                                        foreach($model->assessment as $assessment){
                                            if($assessment->year == $_GET['year'])
                                            if($model->registry_type == "Risk"){
                                                $evaluation = Riskappetite::find()
                                                    ->where('min_rating<=:evaluation')
                                                    ->andWhere('max_rating>=:evaluation')
                                                    ->addParams([':evaluation' => $assessment->evaluation,])
                                                    ->one();
                                            }elseif($model->registry_type == "Opportunity"){
                                                $evaluation = Opportunityappetite::find()
                                                    ->where('min_rating<=:evaluation')
                                                    ->andWhere('max_rating>=:evaluation')
                                                    ->addParams([':evaluation' => $assessment->evaluation,])
                                                    ->one();
                                            }
                                        }
                                        return $evaluation->evaluation;
                                    }else{
                                        
                                    }
                                },
                            ],

                            //$preventive_control_initiatives, $corrective_additional_action, $target_date_of_completion;
                            [
                                'attribute'=>'preventive_control_initiatives',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> ($_GET['registry_type'] == 'Risk') ? 'Preventive Control' : 'Initiatives',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    $preventive_control_initiatives = "";
                                    foreach($model->action as $action){
                                        if($action->year == $_GET['year'])
                                            $preventive_control_initiatives = $action->preventive_control_initiatives;
                                    }
                                    return $preventive_control_initiatives;
                                },
                            ],
                            [
                                'attribute'=>'corrective_additional_action',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> ($_GET['registry_type'] == 'Risk') ? 'Corrective Action' : 'Additional Action',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    $corrective_additional_action = "";
                                    foreach($model->action as $action){
                                        if($action->year == $_GET['year'])
                                            $corrective_additional_action = $action->corrective_additional_action;
                                    }
                                    return $corrective_additional_action;
                                },
                            ],
                            [
                                'attribute'=>'target_date_of_completion',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> 'Target Date of Completion',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    $target_date_of_completion = "";
                                    foreach($model->action as $action){
                                        if($action->year == $_GET['year'])
                                            $target_date_of_completion = $action->target_date_of_completion;
                                    }
                                    return $target_date_of_completion;
                                },
                            ],

                            //$frequency, $target_date, $monitoring_team
                            [
                                'attribute'=>'frequency',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> 'Frequency',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->monitoring ? $model->monitoring->frequency : '-';
                                },
                            ],
                            [
                                'attribute'=>'target_date',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> 'Target Date',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->monitoring ? $model->monitoring->target_date : '-';
                                },
                            ],
                            [
                                'attribute'=>'monitoring_team',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> 'Monitoring Team',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->monitoring ? $model->monitoring->monitoring_team : '-';
                                },
                            ],
                    ],
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
//                    'heading' => $this->title,
                    //'heading' => '<h2 class="panel-title"><i class="fas fa-'.(($qmstype->qms_type_id == 1) ? 'folder' : 'folder-open').'"></i> '.$this->title.'</h2>',
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  $registry_types,
                    'after'=>false,
                ],

            // set export properties
            'export' => [
                'fontAwesome' => true,
                'label' => 'Export',
            ],
            'exportConfig' => [
                'pdf' => [
                    'pdfConfig' => [
                        'methods' => [
                            'SetTitle' => 'Grid Export - Krajee.com',
                            'SetSubject' => 'Generating PDF files via yii2-export extension has never been easy',
                            'SetHeader' => ['Krajee Library Export||Generated On: ' . date("r")],
                            'SetFooter' => ['|Page {PAGENO}|'],
                            'SetAuthor' => 'Kartik Visweswaran',
                            'SetCreator' => 'Kartik Visweswaran',
                            'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, GridView, Grid, yii2-grid, yii2-mpdf, yii2-export',
                        ]
                    ]
                ],
                'xls' => [],
            ],

            // set your toolbar
            'toolbar' => 
                        [
                            [
                                'content'=> 
                                    Html::button('<i class="fas fa-plus"></i>', 
                                        ['value' => Url::to(['registry/create', 
                                                        'registry_type' => $_GET['registry_type'], 
                                                        'year' => $_GET['year']]), 
                                                    'title' => 'Add Registry', 
                                                    'class' => 'btn btn-info', 
                                                    'style'=>'margin-right: 6px; '.( ( (Yii::$app->user->identity->username == 'Admin')) ? '' : 'display: none;'), 
                                                    'id'=>'buttonCreateRegistry'])
                                    ,
                                'options' => ['class' => 'btn-group mr-2 me-2']
                            ],
                            '{export}',
                            //'{toggleData}'
                        ],
            
            'toggleDataOptions' => ['minCount' => 10],
            //'exportConfig' => $exportConfig,
            'itemLabelSingle' => 'item',
            'itemLabelPlural' => 'items'
        ]);
    

        ?>
        <?php Pjax::end(); ?>
</div>