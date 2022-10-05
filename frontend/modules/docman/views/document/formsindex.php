<?php
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

use kartik\datecontrol\DateControl;
use kartik\detail\DetailView;
use kartik\editable\Editable; 
use kartik\grid\GridView;

use yii\bootstrap\Modal;

use common\models\procurement\Division;
use common\models\system\Profile;
use common\models\sec\Blockchain;

/* @var $this yii\web\View */
/* @var $searchModel common\models\finance\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FORMS';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php //echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="request-index">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
<?php Pjax::begin(); ?>
      <?php
        echo GridView::widget([
            'id' => 'request',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
//            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
//            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'columns' => [
//                            'document_id',
                            [
                                'attribute'=>'document_code',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
//                                'value'=>function ($model, $key, $index, $widget) { 
//                                    return '<b>'.$model->request_number.'</b><br/>'.date('Y-m-d', strtotime($model->request_date));
//                                },
                            ],
                            [
                                'attribute'=>'subject',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
//                                'value'=>function ($model, $key, $index, $widget) { 
//                                    return '<b>'.$model->request_number.'</b><br/>'.date('Y-m-d', strtotime($model->request_date));
//                                },
                            ],
                                                        [
                                'attribute'=>'effectivity_date',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
//                                'value'=>function ($model, $key, $index, $widget) { 
//                                    return '<b>'.$model->request_number.'</b><br/>'.date('Y-m-d', strtotime($model->request_date));
//                                },
                            ],
                                            [
                                'attribute'=>'revision_number',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
//                                'value'=>function ($model, $key, $index, $widget) { 
//                                    return '<b>'.$model->request_number.'</b><br/>'.date('Y-m-d', strtotime($model->request_date));
//                                },
                            ],
                            [
                                'class' => kartik\grid\ActionColumn::className(),
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function ($url, $model){
                                        return Html::button('<span class="glyphicon glyphicon-eye-open"></span>', ['value' => '/docman/document/view?id=' . $model->document_id,'onclick'=>'location.href=this.value', 'class' => 'btn btn-primary', 'title' => Yii::t('app', "View Document")]);
                                    },
                                ],
                            ],
                    ],
            
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
//                    'heading' => $this->title,
                    'heading' => 'FORMS',
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  Html::button('<i class="fas fa-plus"></i> Add', ['value' => Url::to(['document/create']), 'title' => 'Add Document', 'class' => 'btn btn-info', 'style'=>'margin-right: 6px;', 'id'=>'buttonCreateRequest']),
                    'after'=>false,
                ],
            // set your toolbar
            'toolbar' => 
                        [
                            [
                                'content'=> '',
                                //'content'=> $category_menus.$toolbars,
                            ],
                            //'{export}',
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