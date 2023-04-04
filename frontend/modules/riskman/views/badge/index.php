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

use common\models\docman\Category;
use common\models\docman\Document;

/* @var $this yii\web\View */
/* @var $searchModel common\models\finance\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Badges';
$this->params['breadcrumbs'][] = $this->title;

// Modal Create Badge
Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalBadge',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();
?>
<div class="request-index">

<?php Pjax::begin(); ?>
      <?php
        echo GridView::widget([
            'id' => 'request',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
//            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
//            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'columns' => [
                            [
                                'attribute'=>'name',
                                'label'=> 'Badge Name',
                                'format'=>'html',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->name;
                                },
                            ],
                            [
                                'attribute'=>'icon',
                                // 'headerOptions' => ['style' => 'width: 10%; text-align: center; vertical-align: middle;'.implode($paramsHeader)],
                                'label'=> 'Icon',
                                // 'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'.$paramsContent],
                                'format'=>'html',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->icon;
                                },
                            ],
                            [
                                'class' => kartik\grid\ActionColumn::className(),
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function ($url, $model){
                                        return Html::button('<span class="glyphicon glyphicon-eye-open"></span>', ['value' => '/docman/document/view?id=' . $model->badge_id,'onclick'=>'location.href=this.value', 'class' => 'btn btn-primary', 'title' => Yii::t('app', "View Badge")]);
                                    },
                                ],
                            ],
                    ],
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
                   'heading' => $this->title,
                    //'heading' => '<h2 class="panel-title"><i class="fas fa-'.(($qmstype->qms_type_id == 1) ? 'folder' : 'folder-open').'"></i> '.$this->title.'</h2>',
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  Html::button('<i class="fas fa-plus"></i> Add', ['value' => Url::to(['badge/create', 'module_id' => Yii::$app->controller->module->id]), 'title' => 'Add Badge', 'class' => 'btn btn-info', 'style'=>'margin-right: 6px; '.( ( (Yii::$app->user->identity->username == 'Admin')) ? '' : 'display: none;'), 'id'=>'buttonCreateBadge']),
                    'after'=>false,
                ],

            // set export properties
            // set your toolbar
            'toolbar' => '',

            
            'toggleDataOptions' => ['minCount' => 10],
            //'exportConfig' => $exportConfig,
            'itemLabelSingle' => 'item',
            'itemLabelPlural' => 'items'
        ]);
    

        ?>
        <?php Pjax::end(); ?>
</div>