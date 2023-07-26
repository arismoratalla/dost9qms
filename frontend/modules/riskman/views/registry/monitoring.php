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

$this->title = 'Registry Monitoring';
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
                            /*[
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
                            ],*/
                            [
                                'attribute'=>'code',
                                'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> $_GET['registry_type'].' Details',
                                'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                                'format'=>'html',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return  '<b>'.$model->code.'</b><br/>'.
                                            '<font color="blue"><b>'.$model->potential.'</b></font><br/>'.
                                            '<i>'.$model->stakeholders.'</i><br/>';
                                            //'<font color="blue"><b>'.$model->customer_requirement.'</b><br/>';
                                            // '<font color="blue"><b>'.$model->potential.'</b><br/>';
                                            // '<i>'.$model->potential.'</i>';
                                },
                            ],
                            [
                                'attribute'=>'evaluation_id',
                                'headerOptions' => ['style' => 'width: 12%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>'1ST QTR',
                                'contentOptions' => ['style' => 'font-weight: bold; width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) {

                                    if($model->assessment){
                                        $evaluation = "";
                                        $remarks = "";
                                        foreach($model->assessment as $assessment){
                                            if($assessment->year == $_GET['year'] && $assessment->qtr == 0){
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
                                                $remarks = isset($assessment->remarks) ? $assessment->remarks : "";
                                            }
                                        }
                                        return ( $evaluation ? explode(' ', trim($evaluation->evaluation))[0].'<br/>(Initial)' : '-' ) . '<br/><br/>' . 
                                                '<span title="'.$remarks.'">'.$remarks.'</span>';
                                    }else{
                                    }
                                },
                            ],
                            [
                                'attribute'=>'evaluation_id',
                                'headerOptions' => ['style' => 'width: 12%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>'2ND QTR',
                                'contentOptions' => ['style' => 'font-weight: bold; width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) {
                                    if($model->assessment){
                                        $evaluation = "";
                                        $remarks = "";
                                        foreach($model->assessment as $assessment){
                                            if($assessment->year == $_GET['year'] && $assessment->qtr == 2){
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
                                                $remarks = isset($assessment->remarks) ? $assessment->remarks : "";
                                            }
                                        }
                                        return ( $evaluation ? explode(' ', trim($evaluation->evaluation))[0] : '-' ) . '<br/><br/>';// . 
                                                //'<span title="'.$remarks.'">'.$remarks.'</span>';
                                    }else{
                                        
                                    }
                                },
                            ],
                            [
                                'attribute'=>'evaluation_id',
                                'headerOptions' => ['style' => 'width: 12%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>'3RD QTR',
                                'contentOptions' => ['style' => 'font-weight: bold; width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) {
                                    if($model->assessment){
                                        $evaluation = "";
                                        $remarks = "";
                                        foreach($model->assessment as $assessment){
                                            if($assessment->year == $_GET['year']  && $assessment->qtr == 3){
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
                                                $remarks = isset($assessment->remarks) ? $assessment->remarks : "";
                                            }
                                        }
                                        return ( $evaluation ? explode(' ', trim($evaluation->evaluation))[0] : '-' ) . '<br/><br/>';// . 
                                                //'<span title="'.$remarks.'">'.$remarks.'</span>';
                                    }else{
                                        
                                    }
                                },
                            ],
                            [
                                'attribute'=>'evaluation_id',
                                'headerOptions' => ['style' => 'width: 12%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>'4TH QTR',
                                'contentOptions' => ['style' => 'font-weight: bold; width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) {
                                    if($model->assessment){
                                        $evaluation = "";
                                        foreach($model->assessment as $assessment){
                                            if($assessment->year == $_GET['year'] && $assessment->qtr == 4){
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
                                                $remarks = isset($assessment->remarks) ? $assessment->remarks : '';
                                            }
                                        }
                                        return ( $evaluation ? explode(' ', trim($evaluation->evaluation))[0] : '-' ) . '<br/><br/>';// . 
                                                //'<span title="'.$remarks.'">'.$remarks.'</span>';
                                    }else{
                                        
                                    }
                                },
                            ],

                            [
                                'attribute'=>'assessment_id',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=>"RMC's Comments / Suggestions",
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    // return $model->assessment->registry_assessment_id;
                                    $effects = "-";
                                    /*foreach($model->assessment as $assessment){
                                        if($assessment->year == $_GET['year'])
                                            $effects = $assessment->effect;
                                    }*/
                                    return $effects;
                                },
                            ],
                    ],
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
                   'heading' => $this->title,
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
                                    $toolbars 
                                    /*.
                                    Html::button('<i class="fas fa-plus"></i>', 
                                        ['value' => Url::to(['registry/create', 
                                                        'registry_type' => $_GET['registry_type'], 
                                                        'year' => $_GET['year'],
                                                        'RegistrySearch["unit_id"]' => isset($_GET['RegistrySearch']['unit_id']) ? $_GET['RegistrySearch']['unit_id'] : '',
                                                    ]), 
                                                    'title' => 'Add Registry', 
                                                    'class' => 'btn btn-info', 
                                                    'style'=>'margin-right: 6px; '.( ( (Yii::$app->user->can('riskman-basic-role'))) ? '' : 'display: none;'), 
                                                    'id'=>'buttonCreateRegistry'])*/
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