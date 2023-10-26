<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\detail\DetailView;
use kartik\editable\Editable;
use kartik\grid\GridView;

use common\models\docman\Issuancetype;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Issuance */

$this->title = $model->issuance_id;
$this->params['breadcrumbs'][] = ['label' => 'Issuances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-4"> 
   
    <?php $attributes = [
        [
            'group'=>true,  
            'label'=>'Details',
            'rowOptions'=>['class'=>'info']
        ],
        [
            'attribute'=>'issuance_type_id',
            'label'=>'Issuance Type',
            'inputContainer' => ['class'=>'col-sm-12'],
            // 'displayOnly'=>true
            'type'=>DetailView::INPUT_SELECT2, 
            'widgetOptions'=>[
                'data' => ArrayHelper::map(Issuancetype::find()->all(),'issuance_type_id','name'),
                'options' => ['placeholder' => 'Select Type'],
                'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
            ],
        ],
        [
            'attribute'=>'date',
            'label'=>'Document Date',
            'inputContainer' => ['class'=>'col-sm-12'],
            // 'displayOnly'=>true
            'type' => DetailView::INPUT_DATE,
            'widgetOptions' => [
                // 'class' => Editable::class,
                // 'inputType' => Editable::INPUT_WIDGET,
                // 'widgetClass' => DatePicker::class,
                'options' => [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd' // Adjust the format as needed
                    ]
                ]
            ],
        ],
        [
            'attribute'=>'code',
            'label'=>'Document Code',
            'inputContainer' => ['class'=>'col-sm-12'],
            // 'displayOnly'=>true
        ],
        [
            'attribute'=>'subject',
            'label'=>'Title',
            'inputContainer' => ['class'=>'col-sm-12'],
            // 'displayOnly'=>true
            'type' => DetailView::INPUT_TEXTAREA,
            'widgetOptions' => [
                'options' => [
                    'rows' => 4, // Adjust the number of rows as needed
                ],
            ],
        ],
    ];?>

    <?= DetailView::widget([
        'model' => $model,
        'mode'=>DetailView::MODE_VIEW,
        'container' => ['id'=>'kv-demo'],
        //'formOptions' => ['action' => Url::current(['#' => 'kv-demo'])] // your action to delete
        // 'buttons1' => ( (Yii::$app->user->identity->username == 'Admin') || Yii::$app->user->can('17025-document-custodian') || Yii::$app->user->can('17025-labrecords-uploader')) ? '{update}' : '', //hides buttons on detail view
        //'buttons1' => '{update}',
        'attributes' => $attributes,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'formOptions' => ['action' => ['issuance/view', 'id' => $model->issuance_id]],
        'panel' => [
            'heading'=>'DOCUMENT DETAILS',
            'type'=>DetailView::TYPE_PRIMARY,
        ],
    ]); ?>
</div>

<!-- <div class="col-md-8">
        <div class="pdf-viewer">
            <iframe src="<?= Yii::getAlias('@web') ?>/js/pdf.js/web/viewer.html?file=<?= urlencode(Yii::getAlias('@web') . '/path-to-your-pdf-file.pdf') ?>" width="100%" height="600px"></iframe>
        </div>
    </div>
</div> -->
