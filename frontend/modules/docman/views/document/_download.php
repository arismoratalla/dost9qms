<?php
 
use kartik\widgets\FileInput;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
]);
echo $form->field($model, 'pdfFile')->widget(FileInput::classname(), [
    'pluginOptions' => [
        'allowedFileExtensions'=>['pdf', 'xls', 'xlsx', 'doc', 'docx'],
        'previewFileType' => 'any',
        'overwriteInitial' => true,
        'initialPreview' => [
            "/uploads/docman/document/" . $model->document->document_code. "/" . $model->filename,
        ],
        'initialPreviewAsData'=>true,
        'initialPreviewConfig'=>[
            [
                'type' => "pdf", 
                'size' => 10000, 
                'caption' => $model->document->filename, 
                'key' => $model->document_attachment_id]
        ],
        
        'fileActionSettings' => [
            'showDrag' => true,
            //'showZoom' => false,
            'showUpload' => true,
            'showDelete' => true,
        ],
        'uploadUrl' => Url::to(['uploads/']) 
    ]
]);
ActiveForm::end(); ?>

<script>
$(document).ready(function(){
    $(".kv-file-remove").hide();
    $(".input-group").hide();
});
</script>