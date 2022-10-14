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

$this->title = $qmstype->code;
$this->params['breadcrumbs'][] = $this->title;

// Modal Create Request
Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalRequest',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();

// Modal Create New Creditor
Modal::begin([
    'header' => '<h4 id="modalCreditorHeader" style="color: #ffffff"></h4>',
    'id' => 'modalCreditor',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();
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
                                'attribute'=>'category_id',
                                'label'=>'Category',
                                'width'=>'120px',
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    if($_GET['qms_type_id'] == 1) {
                                        return ($model->category_id == 2) ? $model->category->name : 'Procedures Manual';
                                    } elseif($_GET['qms_type_id'] == 2){
                                        return ($model->category_id == 2) ? 'Operational Procedure' : $model->category->name;
                                    }
                                },
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ArrayHelper::map(Category::find()->where(['<>', 'code', 'F'])->asArray()->all(), 'category_id', 'name'), 
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],  
                                'filterInputOptions' => ['placeholder' => 'Select Category'],
                            ],
                            [
                                'attribute'=>'document_code',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: left;'],
                                'width'=>'120px',
                                'format'=>'raw',
                            ],
                            [
                                'attribute'=>'subject',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: left;'],
                                'width'=>'120px',
                                'format'=>'raw',
                            ],
                                                        [
                                'attribute'=>'effectivity_date',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
                            ],
                                            [
                                'attribute'=>'revision_number',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
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
                    'heading' => '<h2 class="panel-title"><i class="fas fa-'.(($qmstype->qms_type_id == 1) ? 'folder' : 'folder-open').'"></i> '.$this->title.'</h2>',
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  Html::button('<i class="fas fa-plus"></i> Add', ['value' => Url::to(['document/create', 'qms_type_id' => $_GET['qms_type_id']]), 'title' => 'Add Document', 'class' => 'btn btn-info', 'style'=>'margin-right: 6px;', 'id'=>'buttonCreateRequest']),
                    'after'=>false,
                ],

            // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            'exportConfig' => [
                'html' => [],
                'csv' => [],
                'txt' => [],
                'xls' => [],
                'pdf' => [],
                'json' => [],
            ],

            // set your toolbar
            'toolbar' => 
                        [
                            [
                                'content'=> $toolbars,
                                //'content' =>
                                //Html::button('<i class="fas fa-plus"></i> Add', ['value' => Url::to(['document/create', 'qms_type_id' => $_GET['qms_type_id']]), 'title' => 'Add Document', 'class' => 'btn btn-info', 'style'=>'margin-right: 6px;', 'id'=>'buttonCreateRequest']),
                                    /*Html::button('<i class="fas fa-plus"></i>', [
                                        'class' => 'btn btn-success',
                                        // 'title' => Yii::t('kvgrid', 'Add Book'),
                                        'onclick' => 'alert("This should launch the book creation form.\n\nDisabled for this demo!");'
                                    ]) . ' '.
                                    Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
                                        'class' => 'btn btn-outline-secondary',
                                        // 'title'=>Yii::t('kvgrid', 'Reset Grid'),
                                        'data-pjax' => 0, 
                                    ]), */
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