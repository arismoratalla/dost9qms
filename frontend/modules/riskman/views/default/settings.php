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
?>   

<section class="content">
<!-- <div class="registry-index"> -->

<div class="row">
        
        <div class="col-lg-8 col-xs-6">

<?php Pjax::begin(); ?>
    <?php

        echo GridView::widget([
            'id' => 'app-settings',
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'responsive' => true,
            'tableOptions' => [
                'style' => 'table-layout: fixed;',
                // 'class' => 'table table-striped table-bordered',
            ],
            'columns' => [
                            [
                                'attribute'=>'name',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'],
                                'label'=> 'Name',
                                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                                // 'value'=>function ($model, $key, $index, $widget) { 
                                    
                                // },
                            ],
                            [
                                'attribute'=>'code',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'],
                                'label'=> 'Code',
                                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                                // 'value'=>function ($model, $key, $index, $widget) { 
                                    
                                // },
                            ],
                            [
                                'attribute'=>'setting',
                                'headerOptions' => ['style' => 'width: 6%; text-align: center; vertical-align: middle;'],
                                'label'=> 'setting',
                                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                                // 'value'=>function ($model, $key, $index, $widget) { 
                                    
                                // },
                            ],
                    ],
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
                    // 'heading' => $this->title,
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  '',
                    'after'=>false,
                ],

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