<?php 
use yii\bootstrap\Modal;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use kartik\grid\GridView;

$this->title = 'Dashboard';
// $this->params['breadcrumbs'][] = ['label' => 'Docman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalContainer',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();
/*
$date = date('Y-m-d');
echo $date;
echo '<br/>';
$month = date('n');
echo $month;
echo '<br/>';
$day = getdate(date("U"));
echo "$day[mday]";
echo '<br/>';
$qtr = ceil($month / 3);
echo $qtr;
echo '<br/>';
echo date('Y');
*/
//echo $model->status_id.'<br/>';
// echo Yii::$app->user->identity->profile->groups;
// echo '<br/>';
// print_r( explode(',', Yii::$app->user->identity->profile->groups) );
//echo Os::generateOsNumber($model->request->obligation_type_id,$model->request->request_date);
?>   

<section class="content">
<!-- <div class="registry-index"> -->

<div class="row">
        
        <div class="col-lg-8 col-xs-6">

<?php Pjax::begin(); ?>
      <?php

        echo GridView::widget([
            'id' => 'request',
            'dataProvider' => $timelinessCompleteness,
            'responsive' => true,

            'tableOptions' => [
                'style' => 'table-layout: fixed;',
            ],
            'columns' => [
                            [
                                'attribute'=>'unit_id',
                                'headerOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                                'label'=>'Functional Unit',
                                'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'],
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                  return $model->functionalunit->name;
                                },
                            ],
                            [
                                'attribute'=>'date_achieved',
                                'headerOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                                'label'=>'Date Achieved',
                                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                                'format'=>'raw',
                                // 'value'=>function ($model, $key, $index, $widget) { 
                                //     // return $model->assessment->registry_assessment_id;
                                //     $cause = "";
                                //     foreach($model->assessment as $assessment){
                                //         if($assessment->year == $_GET['year'])
                                //             $cause = $assessment->cause;
                                //     }
                                //     return $cause;
                                // },
                            ],
                    ],
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
                    'heading' => 'Timeliness and Completeness',
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  '',
                    'after'=>false,
                ],

            // set export properties
            'export' => [
                'fontAwesome' => true,
                'label' => 'Export',
            ],

            // set your toolbar
            'toolbar' => 
                        [
                            [
                                'content'=> '',
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
</div>
<!-- </div> -->
</section>