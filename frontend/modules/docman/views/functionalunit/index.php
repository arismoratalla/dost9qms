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

use common\models\docman\Division;
// use common\models\system\Appsettings;
use common\models\system\Profile;
// use common\models\system\Usersection;
// use common\models\sec\Blockchain;
/* @var $this yii\web\View */
/* @var $searchModel common\models\finance\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Functional Units';
$this->params['breadcrumbs'][] = $this->title;

// Modal Add Setting
Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalAddSetting',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();

// Modal Update Setting
Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalUpdateSetting',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();
?>

<?php //echo Yii::$app->controller->module->id;?>
<div class="appsettings-index">
<?php Pjax::begin(); ?>
     
      <?php
        echo GridView::widget([
            'id' => 'settings',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'columns' => [  
                            [
                                // 'class' => 'kartik\grid\EditableColumn',
                                'attribute'=>'division_id',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'background-color: #76B5C5; vertical-align:middle; text-align: left; font-weight: bold;'],
                                'width'=>'25%',
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->division_id ? Division::findOne($model->division_id)->name : "";
                                },
                                'hAlign' => 'right', 
                                'vAlign' => 'middle',
                                'group'=>true,  // enable grouping,
                                'groupedRow'=>true,   
                            ],
                            [
                                'attribute'=>'name',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: left; padding-left: 20px;'],
                                'width'=>'30%',
                                'format'=>'raw',
                                /*'value'=>function ($model, $key, $index, $widget) { 
                                    return '<b>'.$model->request_number.'</b><br/>'.date('Y-m-d', strtotime($model->request_date));
                                },*/
                            ],
                            [
                                'attribute'=>'code',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: left; padding-left: 20px;'],
                                'width'=>'30%',
                                'format'=>'raw',
                                /*'value'=>function ($model, $key, $index, $widget) { 
                                    return '<b>'.$model->request_number.'</b><br/>'.date('Y-m-d', strtotime($model->request_date));
                                },*/
                            ],
                            [
                                'class' => 'kartik\grid\EditableColumn',
                                'attribute'=>'unit_head',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width' => '25%',
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->unit_head ? Profile::findOne($model->unit_head)->fullname : "";
                                },
                                'editableOptions'=> function ($model , $key , $index) {
                                    return [
                                        'options' => ['id' => $index],
                                        'placement'=>'left',
                                        'name'=>'district',
                                        'asPopover' => true,
                                        // 'disabled'=> ($model->index_type === "user") ? false : true,
                                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                                        'data'=>  ArrayHelper::map(
                                                        Profile::find()
                                                            ->joinWith([
                                                                'user' => function ($query) {
                                                                    $query->andWhere(['=', 'status', 10]);
                                                                },
                                                            ])
                                                            // ->joinWith('user')
                                                            // ->where(['user.status'=>10])
                                                            ->orderBy(['firstname' => SORT_ASC])
                                                            ->asArray()
                                                            ->all()
                                                        , 'profile_id', 
                                            function($model) {
                                                return $model['firstname'].' '.$model['lastname'];
                                            }
                                        ),
                                        'formOptions'=>['action' => ['/docman/functionalunit/assignunithead']], // point to the new action
                                    ];
                                },
                                'hAlign' => 'right', 
                                'vAlign' => 'middle',
                            ],
                    ],
            
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
                    'heading' => Html::encode($this->title),
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  Html::button('New Setting', ['value' => Url::to(['appsettings/create']), 'title' => 'Add Setting', 'class' => 'btn btn-info', 'style'=>'margin-right: 6px;', 'id'=>'buttonAddSetting']),
                    'after'=>false,
                ],
            // set your toolbar
            'toolbar' => 
                        [
                            [
                                'content'=> '',
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