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

use common\models\docman\Docattachment;
use common\models\docman\Section;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Doc */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $model->section->doccategory->name;
$this->params['breadcrumbs'][] = $model->section->name;
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
            'attribute'=>'code',
            'label'=>'Document Code',
            'inputContainer' => ['class'=>'col-sm-4'],
            // 'displayOnly'=>true
        ],
        [
            'attribute'=>'name',
            'label'=>'Name',
            'inputContainer' => ['class'=>'col-sm-4'],
            // 'displayOnly'=>true
        ],
        [
            'attribute'=>'section_id',
            'label'=>'Category',
            'inputContainer' => ['class'=>'col-sm-4'],
            'value' => $model->section->name,
            // 'displayOnly'=>true,
            'type'=>DetailView::INPUT_SELECT2, 
            'widgetOptions'=>[
                'data'=>ArrayHelper::map(Section::find()->all(),'section_id','name'),
                'options' => ['placeholder' => 'Select Section'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
            ],
        ],
        [
            'attribute'=>'revision_num',
            'label'=>'Revision Number',
            'inputContainer' => ['class'=>'col-sm-4'],
            'value' => ($model->revision_num < 0 ) ? 'N/A' : $model->revision_num,
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
        'buttons1' => ( (Yii::$app->user->identity->username == 'Admin') || Yii::$app->user->can('9001-document-custodian')) ? '{update}' : '', //hides buttons on detail view
        'attributes' => $attributes,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'formOptions' => ['action' => ['doc/view', 'id' => $model->doc_id]],
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
            [   
                'attribute'=>'filename',
                'header' => 'Download',
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                'visible' => ( (Yii::$app->user->identity->username == 'Admin') || Yii::$app->user->can('9001-document-custodian')) ? false : true,
                'format' => 'raw',
                'width'=>'80px',
                'value'=>function ($model, $key, $index, $widget) { 
                    $btnCss = [];
                    $status = Docattachment::hasAttachment($model->doc_attachment_id);
                    
                    switch($status){
                        case 0:
                            $btnCss = 'btn btn-danger';
                            break;
                        case 1:
                                $btnCss = 'btn btn-success';
                            break;
                    }
                    return Html::button('<i class="glyphicon glyphicon-file"></i> '.($status ? 'View' : 'Upload'), ['value' => Url::to(['doc/downloadattachment', 'id'=>$model->doc_attachment_id]), 'title' => Yii::t('app', "Attachment"), 'class' => $btnCss, 'style'=>'margin-right: 6px; display: "";', 'id'=>'buttonUploadDocument']);// . 
                },
            ],
            [   
                'attribute'=>'filename',
                'header' => 'Upload',
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                'visible' => ( (Yii::$app->user->identity->username == 'Admin') || Yii::$app->user->can('17025-document-custodian') || Yii::$app->user->can('17025-labrecords-uploader')) ? true : false,
                'format' => 'raw',
                'width'=>'80px',
                'value'=>function ($model, $key, $index, $widget) { 
                    $btnCss = [];
                    $status = Docattachment::hasAttachment($model->doc_attachment_id);
                    
                    switch($status){
                        case 0:
                            $btnCss = 'btn btn-danger';
                            break;
                        case 1:
                                $btnCss = 'btn btn-success';
                            break;
                    }
                    return Html::button('<i class="glyphicon glyphicon-file"></i> '.($status ? 'View' : 'Upload'), ['value' => Url::to(['doc/uploadattachment', 'id'=>$model->doc_attachment_id]), 'title' => Yii::t('app', "Attachment"), 'class' => $btnCss, 'style'=>'margin-right: 6px; display: "";', 'id'=>'buttonUploadDocument']);// . 
                },
            ],
            
        ];
    ?>
<?= GridView::widget([
            'id' => 'document-attachments',
            'dataProvider' => $attachmentsDataProvider,
            'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'panel' => [
                'heading' => '<h3 class="panel-title">Attachments</h3>',
                'type' => GridView::TYPE_PRIMARY,
                'before'=> false,
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
            'itemLabelSingle' => 'item',
            'itemLabelPlural' => 'items'
        ]);

    
    ?>

