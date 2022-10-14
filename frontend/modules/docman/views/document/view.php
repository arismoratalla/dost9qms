<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\detail\DetailView;
use kartik\editable\Editable;
use kartik\grid\GridView;
use kartik\widgets\SwitchInput;

use yii\bootstrap\Modal;

use common\models\docman\Category;
use common\models\docman\Documentattachment;

/* @var $this yii\web\View */
/* @var $model common\models\documentmanagement\Document */

$this->title = $model->document_id;
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
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
    
<?php $attributes = [
        [
            'group'=>true,  
            'label'=>'Details',
            'rowOptions'=>['class'=>'info']
        ],
        [
            'attribute'=>'document_code',
            'label'=>'Document Code',
            'inputContainer' => ['class'=>'col-sm-4'],
            // 'displayOnly'=>true
        ],
        [
            'attribute'=>'subject',
            'label'=>'Title',
            'inputContainer' => ['class'=>'col-sm-4'],
            // 'displayOnly'=>true
        ],
        [
            'attribute'=>'category_id',
            'label'=>'Category',
            'inputContainer' => ['class'=>'col-sm-4'],
            'value' => $model->category->name,
            // 'displayOnly'=>true,
            'type'=>DetailView::INPUT_SELECT2, 
            'widgetOptions'=>[
                'data'=>ArrayHelper::map(Category::find()->all(),'category_id','name'),
                'options' => ['placeholder' => 'Select Type'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
            ],
        ],
        [
            'attribute'=>'revision_number',
            'label'=>'Revision Number',
            'inputContainer' => ['class'=>'col-sm-4'],
            // 'displayOnly'=>true
        ],
        [
            'attribute'=>'effectivity_date',
            'label'=>'Effectivity Date',
            'type'=>DetailView::INPUT_DATE,
            'inputContainer' => ['class'=>'col-sm-4'],
            // 'displayOnly'=>true
        ],
    ];?>
<?= DetailView::widget([
        'model' => $model,
        'mode'=>DetailView::MODE_VIEW,
        'container' => ['id'=>'kv-demo'],
        //'formOptions' => ['action' => Url::current(['#' => 'kv-demo'])] // your action to delete
        'buttons1' => ( (Yii::$app->user->identity->username == 'Admin') || Yii::$app->user->can('17025-docman')) ? '{update}' : '', //hides buttons on detail view
        //'buttons1' => '{update}',
        'attributes' => $attributes,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'formOptions' => ['action' => ['document/view', 'id' => $model->document_id]],
        'panel' => [
            'heading'=>'DOCUMENT DETAILS',
            'type'=>DetailView::TYPE_PRIMARY,
        ],
    ]); ?>
<?php 
        $gridColumns = [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'width' => '10px',
                'header' => '',
            ],
            [   
                'attribute'=>'filename',
                'header' => 'Document Type',
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle; text-transform: uppercase;'],
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return 'Attachment';
                },
            ],
            /*[
                'attribute'=>'filename',
                'header' => 'Filename',
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'text-align: left; vertical-align: middle;'],
                'width'=>'100px'
            ],*/
            [   
                'attribute'=>'filename',
                'header' => 'Attachments',
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                'format' => 'raw',
                'width'=>'80px',
                'value'=>function ($model, $key, $index, $widget) { 
                    $btnCss = [];
                    $status = Documentattachment::hasAttachment($model->document_attachment_id);
                    
                    switch($status){
                        case 0:
                            $btnCss = 'btn btn-danger';
                            break;
                        case 1:
                                $btnCss = 'btn btn-success';
                            break;
                    }
                    return Html::button('<i class="glyphicon glyphicon-file"></i> '.($status ? 'View' : 'Upload'), ['value' => Url::to(['document/uploadattachment', 'id'=>$model->document_attachment_id]), 'title' => Yii::t('app', "Attachment"), 'class' => $btnCss, 'style'=>'margin-right: 6px; display: "";', 'id'=>'buttonUploadDocument']);// . 
                },
            ],
            
        ];
    ?>
<?= GridView::widget([
            'id' => 'document-attachments',
            'dataProvider' => $attachmentsDataProvider,
            //'filterModel' => $searchModel,
            'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
//            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
//            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            //'pjax' => true, // pjax is set to always true for this demo
            // set left panel buttons
            /*'panel' => [
                'heading'=>'<h3 class="panel-title">Attachments</h3>',
                'type'=>'primary',
            ],*/    
            'panel' => [
                'heading' => '<h3 class="panel-title">Attachments</h3>',
                'type' => GridView::TYPE_PRIMARY,
                //'before'=> (($model->status_id == Request::STATUS_VALIDATED) || ($model->status_id == Request::STATUS_VERIFIED)) ? 
                'before'=> '',
                
                //Html::button('Submit', ['value' => Url::to(['request/submit', 'id'=>$model->document_id]), 'title' => 'Submit', 'class'=>'btn btn-success', 'style'=>'margin-right: 6px;', 'id'=>'buttonTest']),
                'after'=>false,
            ],
            // set right toolbar buttons
            'toolbar' => '',
            // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],
            //'exportConfig' => $exportConfig,
            'itemLabelSingle' => 'item',
            'itemLabelPlural' => 'items'
        ]);

    
    ?>

<script>
$( document ).ready(function() {
    console.log( "ready!" );
    //alert('haha');
});
</script>
