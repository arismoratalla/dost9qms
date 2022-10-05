<?php
use common\modules\admin\components\Helper;

use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;



/* @var $this yii\web\View */
/* @var $searchModel common\modules\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Groups');
$this->params['breadcrumbs'][] = $this->title;

// Modal User
Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalUser',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();

?>
<div class="user-index">
    <?= $this->renderFile(__DIR__.'/../menu.php',['button'=>'user']); ?>
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Groups</div>
        <div class="panel-body">
        
           <?php echo GridView::widget([
            'id' => 'ppmp3',
            'dataProvider' => $sectionsDataProvider,
            'columns' => [
                            [
                                'attribute'=>'division', 
                                'width'=>'150px',
                                'contentOptions' => ['style' => 'max-width:25px;white-space:normal;word-wrap:break-word;font-weight:bold'],
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->division->name;
                                },
                                'group'=>true,  // enable grouping,
                                'groupedRow'=>true,                    // move grouped column to a single grouped row
                                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
                            ],
                            [
                                'attribute'=>'name',
                                'contentOptions' => ['style' => 'padding-left: 25px'],
                                'width'=>'150px',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->name;
                                },
                            ],
                            [
                                'attribute'=>'ppmp',
                                'header'=>'Members',
                                'width'=>'550px',
                                'format'=>'raw',
                                'value'=>function($model,$key,$index,$widget) {
                                    return $model->getMembers();
                                },
                            ],
                    ],
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                //'heading' => $heading,
            ],
            'toolbar' => 
                        [
                            [
                                'content'=>
                                    Html::button('Assign', ['value' => Url::to(['usersection/create']), 'title' => 'User Assignment', 'class' => 'btn btn-success', 'style'=>'margin-right: 6px;', 'id'=>'buttonAssign']) 
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
        </div>
    </div>
</div>
