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

$this->title = 'Draft Registries';
$this->params['breadcrumbs'][] = $this->title;

// Modal Create Registry
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
    'id' => 'modalApprove',
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
                                'headerOptions' => ['style' => 'width: 2%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> '#',
                                'contentOptions' => ['style' => 'width: 2%; text-align: center; vertical-align: middle;'],
                                'visible' => Yii::$app->user->can('riskman-manager'),
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return Html::button('<i class="fas fa-edit"></i>', 
                                        ['value' => Url::to(['registry/approve', 
                                                            'id' => $model->registry_id, 
                                                            // 'registry_type' => $model->registry_type, 
                                                            //'year' => $_GET['year'] 
                                                        ]), 
                                        'title' => 'Approve Registry', 
                                        'class' => 'btn btn-info', 
                                        'style'=>'margin-right: 6px;', 'id'=>'buttonApproveRegistry']);
                                    },
                            ],
                            [
                                'attribute'=>'registry_type',
                                'headerOptions' => ['style' => 'width: 4%; text-align: center; vertical-align: middle;'],
                                'label'=> 'Registry Type',
                                'contentOptions' => ['style' => 'width: 4%; text-align: left; vertical-align: middle;'],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) use ($paramsContent){ 
                                    return '<font color="'.$paramsContent[$model->registry_type].'"><b>'.strtoupper($model->registry_type).'</font></b>';
                                },
                            ],
                            [
                                'attribute'=>'code',
                                'headerOptions' => ['style' => 'width: 25%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> (isset($_GET['registry_type']) ? $_GET['registry_type'] : '').' Details',
                                'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'.$paramsContent['no-wrap']],
                                'format'=>'html',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return  '<font color="blue"><b>'.$model->potential.'</b></font><br/>'.
                                            '<i>'.$model->stakeholders.'</i><br/>';
                                            
                                            // '<i>'.$model->potential.'</i>';
                                },
                            ],

                            //$frequency, $target_date, $monitoring_team
                            [
                                'attribute'=>'frequency',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> 'Frequency',
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'],
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
                                'contentOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'.$paramsContent['no-wrap']],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->monitoring ? $model->monitoring->monitoring_team : '-';
                                },
                            ],
                    ],
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
                   'heading' => $this->title,
                    //'heading' => '<h2 class="panel-title"><i class="fas fa-'.(($qmstype->qms_type_id == 1) ? 'folder' : 'folder-open').'"></i> '.$this->title.'</h2>',
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  '',//$buttons,
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
                            'SetTitle' => 'Draft Registries',
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
                                'content'=> ''//(date("Y-m-d") >= date_format(date_create("2023-04-11"),"Y-m-d") ) ?
                                    /*Html::button('<i class="fas fa-plus"></i>', 
                                    ['value' => Url::to(['registry/create',
                                                ]), 
                                                'title' => 'Add Registry', 
                                                'class' => 'btn btn-info', 
                                                'style'=>'margin-right: 6px; '.( ( (Yii::$app->user->can('riskman-basic-role'))) ? '' : 'display: none;'), 
                                                'id'=>'buttonCreateRegistry'])*/ //: ''
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