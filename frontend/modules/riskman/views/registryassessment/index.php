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
use common\models\riskman\Registryaction;
use common\models\riskman\Opportunityappetite;
// use common\models\docman\Category;
// use common\models\docman\Document;

/* @var $this yii\web\View */
/* @var $searchModel common\models\finance\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registry Management';
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
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalAssessment',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();

// Modal View Registry
Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalViewRegistry',
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
                    'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    // 'label'=> $_GET['registry_type'].' Details',
                    'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                    'format'=>'raw',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return  
                                '<div style="float: left; margin-left: -4px; margin-right: 15px; margin-top: 15px;">' .
                                Html::button('<i class="fas fa-eye"></i>', 
                                    ['value' => Url::to(['registry/view', 'id' => $model->registry->registry_id]), 
                                    'title' => 'View Registry', 
                                    'class' => 'btn btn-info', 
                                    'style'=>'margin-left: 6px;', 
                                    'id'=>'buttonViewRegistry']) . 
                                '</div>'.
                                // '&nbsp;&nbsp;' .  
                                // Html::button('<i class="fas fa-edit"></i>', 
                                // ['value' => Url::to(['registry/update', 'registry_id' => $model->registry_id]), 
                                // 'title' => 'View Assessment', 
                                // 'class' => 'btn btn-info', 
                                // 'style'=>'margin-right: 6px;', 'id'=>'buttonViewRegistry']).

                                '<div style="float: left;"><b>'.

                                Html::a($model->registry->code, 
                                    Url::to(['registry/view', 'id' => $model->registry_id]),
                                    [   'style' => 'cursor:pointer; font-size: medium; font-weight: bold;', 
                                        'id' => 'linkViewRegistry',
                                        'target' => '_blank',
                                    ]). 

                                '</b> <i>( '.$model->registry->stakeholders.' )</i>'. 

                                // '<i>'.$model->registry->stakeholders.'</i><br/>'.
                                '<br/><font color="blue"><b>'.$model->registry->potential.'</b><br/>';
                                // '<br/><font color="blue"><b>'.$model->registry->customer_requirement.'</b><br/>'.
                                // $model->registry->potential . '</div>';


                                // Html::a($model->registry->code, ['registry/view', 'id'=>$model->registry_id], 
                                // ['style' => 'cursor:pointer; font-size: medium; font-weight: bold;', 'id' => 'viewRegistry'])
                    },
                    'group'=>true,  // enable grouping,
                    'groupedRow'=>true,                    // move grouped column to a single grouped row
                ],
                [
                    'attribute'=>'registry_assessment_id',
                    'headerOptions' => ['style' => 'width: 10%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> '#',
                    'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                    'format'=>'raw',
                    'value'=>function ($model, $key, $index, $widget) { 
                        // return '';
                        //  Html::button('<i class="fas fa-edit"></i>', 
                        //             ['value' => Url::to(['registry/view', 'id' => $model->registry->registry_id]), 
                        //             'title' => 'View Registry', 
                        //             'class' => 'btn btn-info', 
                        //             'style'=>'margin-left: 6px;', 
                        //             'id'=>'buttonViewRegistry']) . 

                         return Html::button('<i class="fas fa-edit"></i>', 
                                ['value' => Url::to(['registryassessment/update', 
                                                    'id' => $model->registry_assessment_id,
                                                    'registry_type' => $_GET['registry_type'], 
                                                    'year' => $_GET['year'] 
                                                    ]
                                                ), 
                                'title' => 'Update Assessment', 
                                'class' => $model->evaluation ? 'btn btn-info' : 'btn btn-warning', 
                                'style'=>'margin-right: 6px;', 
                                'id'=>'buttonViewRegistry']);
                    },
                ],
                /*[
                    'class' => kartik\grid\ActionColumn::className(),
                    'template' => '{update}',
                    'header' => '#',
                    'headerOptions' => ['style' => 'width: 10%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'buttons' => [

                        'view' => function ($url, $model){
                            return Html::button('<span class="glyphicon glyphicon-edit"></span>', 
                                [
                                    'value' => '/finance/request/view?id=' . $model->registry_id,
                                    'onclick'=>'location.href=this.value', 
                                    'class' => 'btn btn-primary', 
                                    'title' => Yii::t('app', "View Request")
                                ]);
                        },
                    ],
                ],*/
                [
                    'attribute'=>'qtr',
                    'headerOptions' => ['style' => 'width: 10%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> 'Qtr',
                    'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'.$paramsContent],
                    'format'=>'html',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return 'Q'.$model->qtr;
                    },
                ],
                [
                    'attribute'=>'likelihood_id',
                    'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> 'Likelihood',
                    'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                    'format'=>'html',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return  $model->likelihood ? $model->likelihood->scale : '-';
                    },
                ],
                [
                    'attribute'=>'cause',
                    'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> 'Trigger',
                    'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                    'format'=>'html',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return  $model->cause;
                    },
                ],
                [
                    'attribute'=>'benefit_consequence_id',
                    'headerOptions' => ['style' => 'width: 15%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> ( ($_GET['registry_type'] == "Risk") ? "Consequence" : "Benefit"),
                    'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                    'format'=>'html',
                    'value'=>function ($model, $key, $index, $widget) { 
                        if($_GET['registry_type'] == "Risk"){
                            return $model->consequence ? $model->consequence->scale : '-';
                        }elseif($_GET['registry_type'] == "Opportunity"){
                            return $model->benefit ? $model->benefit->scale : '-';
                        }
                    },
                ],
                [
                    'attribute'=>'effect',
                    'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> 'Effect',
                    'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                    'format'=>'html',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return  $model->effect;
                    },
                ],

                [
                    'attribute'=>'evaluation',
                    'headerOptions' => ['style' => 'width: 20%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=>'Evaluation',
                    'contentOptions' => ['style' => 'font-weight: bold; width: 15%; text-align: center; vertical-align: middle;'.$paramsContent],
                    'format'=>'raw',
                    'value'=>function ($model, $key, $index, $widget) {
                        if($model->registry->registry_type == "Risk"){
                            $evaluation = Riskappetite::find()
                                ->where('min_rating<=:evaluation')
                                ->andWhere('max_rating>=:evaluation')
                                ->addParams([':evaluation' => $model->evaluation,])
                                ->one();
                        }elseif($model->registry->registry_type == "Opportunity"){
                            $evaluation = Opportunityappetite::find()
                                ->where('min_rating<=:evaluation')
                                ->andWhere('max_rating>=:evaluation')
                                ->addParams([':evaluation' => $model->evaluation,])
                                ->one();
                        }
                        return $evaluation ? explode(' ', trim($evaluation->evaluation))[0] : '-';
                    },
                ],

                //$preventive_control_initiatives, $corrective_additional_action, $target_date_of_completion;
                [
                    'attribute'=>'preventive_control_initiatives',
                    'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> ( ($_GET['registry_type'] == "Risk") ? "Preventive Control" : "Initiative"),
                    'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                    'format'=>'html',
                    'value'=>function ($model, $key, $index, $widget) { 
                        $action = Registryaction::find()->where([
                                'registry_id' => $model->registry_id,
                                'qtr' => $model->qtr,
                                'year' => $model->year,
                            ])->one();
                        return $action ? $action->preventive_control_initiatives : "-";
                    },
                ],
                [
                    'attribute'=>'corrective_additional_action',
                    'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> ( ($_GET['registry_type'] == "Risk") ? "Corrective Action" : "Additional Action"),
                    'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                    'format'=>'html',
                    'value'=>function ($model, $key, $index, $widget) { 
                        $action = Registryaction::find()->where([
                                'registry_id' => $model->registry_id,
                                'qtr' => $model->qtr,
                                'year' => $model->year,
                            ])->one();
                        return $action ? $action->corrective_additional_action : "-";
                    },
                ],
                [
                    'attribute'=>'target_date_of_completion',
                    'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=>  'Target Date',
                    'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent],
                    'format'=>'html',
                    'value'=>function ($model, $key, $index, $widget) { 
                        $action = Registryaction::find()->where([
                                'registry_id' => $model->registry_id,
                                'qtr' => $model->qtr,
                                'year' => $model->year,
                            ])->one();
                        return $action ? $action->target_date_of_completion : "-";
                    },
                ],

                //$frequency, $target_date, $monitoring_team
                [
                    'attribute'=>'frequency',
                    'headerOptions' => ['style' => 'width: 10%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> 'Frequency',
                    'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'.$paramsContent],
                    'format'=>'raw',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return $model->registry->monitoring ? $model->registry->monitoring->frequency : '-';
                    },
                ],
                [
                    'attribute'=>'target_date',
                    'headerOptions' => ['style' => 'width: 10%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> 'Target Date',
                    'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                    'format'=>'raw',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return $model->registry->monitoring ? $model->registry->monitoring->target_date : '-';
                    },
                ],
                [
                    'attribute'=>'monitoring_team',
                    'headerOptions' => ['style' => 'width: 10%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                    'label'=> 'Monitoring Team',
                    'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'.$paramsContent],
                    'format'=>'raw',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return $model->registry->monitoring ? $model->registry->monitoring->monitoring_team : '-';
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
                                    $toolbars . 
                                    Html::button('<i class="fas fa-plus"></i>', 
                                        ['value' => Url::to(['registry/create', 
                                                        'registry_type' => $_GET['registry_type'], 
                                                        'year' => $_GET['year'],
                                                        'RegistrySearch["unit_id"]' => isset($_GET['RegistrySearch']['unit_id']) ? $_GET['RegistrySearch']['unit_id'] : '',
                                                    ]), 
                                                    'title' => 'Add Registry', 
                                                    'class' => 'btn btn-info', 
                                                    'style'=>'margin-right: 6px; '.( ( (Yii::$app->user->can('riskman-basic-role'))) ? '' : 'display: none;'), 
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