<?php
use kartik\widgets\FileInput;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Badge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="badge-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]); ?>


    <?= $form->field($model, 'module_id')->hiddenInput()->label(false) ?>

    <div class="row">
        <div class="col-md-6"> 
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6"> 
            <?= $form->field($model, 'award_type')->dropDownList([ 'INDIVIDUAL' => 'INDIVIDUAL', 'GROUP' => 'GROUP', '' => '', ], ['prompt' => '']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6"> 
            <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
        </div>

        <div class="col-md-6"> 
            <?= $form->field($model, 'criteria')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <?= $form->field($model, 'icon')->widget(FileInput::classname(), [
        //'disabled' => $model->request->owner() ? false : true, //this also disables buttons on fileActionSettings below
        'pluginOptions' => [
            'allowedFileExtensions'=>['png', 'svg', 'ico'],
            //'showPreview' => true,
            'previewFileType' => 'any',
            'overwriteInitial' => true,
            //'initialPreview' =>[Requestattachment::checkFile($model->attachment_id)],
            'initialPreview' => [
                "/uploads/".Yii::$app->controller->module->id."/badges/" . "/" . $model->icon,
            ],
            'initialPreviewAsData'=>true,
            'initialPreviewConfig'=>[
                [
                    'type' => "pdf", 
                    'size' => 10000, 
                    'caption' => $model->icon, 
                    //'url' => Url::to(['request/deleteattachment']), 
                    'key' => $model->badge_id]
            ],
            
            'fileActionSettings' => [
                'showDrag' => false,
                //'showZoom' => false,
                //'showUpload' => $model->request->owner() ? true : false,
                //'showDelete' => $model->request->owner() ? true : false,
            ],
            'uploadUrl' => Url::to(['uploads/'.Yii::$app->controller->module->id.'/badges/']) 
        ]
    ]);
?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
