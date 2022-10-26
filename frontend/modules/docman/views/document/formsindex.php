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
            'columns' => [
//                            'document_id',
                            [
                                'attribute'=>'document_code',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
                            ],
                            [
                                'attribute'=>'subject',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
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
                    'heading' => 'FORMS',
                    'type' => GridView::TYPE_PRIMARY,
                    //'before'=>  Html::button('<i class="fas fa-plus"></i> Add', ['value' => Url::to(['document/createform']), 'title' => 'Add Document', 'class' => 'btn btn-info', 'style'=>'margin-right: 6px;', 'id'=>'buttonCreateForm']),
                    'before'=>  Html::button('<i class="fas fa-plus"></i> Add', ['value' => Url::to(['document/createform', 'qms_type_id' => $_GET['qms_type_id']]), 'title' => 'Add Form', 'class' => 'btn btn-info', 'style'=>'margin-right: 6px; '.( ( (Yii::$app->user->identity->username == 'Admin') || Yii::$app->user->can('17025-document-custodian')) ? '' : 'display: none;'), 'id'=>'buttonCreateRequest']),
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