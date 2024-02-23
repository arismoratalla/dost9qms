<?php
 
use kartik\widgets\FileInput;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//use common\models\finance\Requestattachment;

$form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
]);


echo $form->field($model, 'pdfFile')->widget(FileInput::classname(), [
    //'disabled' => $model->request->owner() ? false : true, //this also disables buttons on fileActionSettings below
    'pluginOptions' => [
        'allowedFileExtensions'=>['pdf', 'xls', 'xlsx', 'doc', 'docx'],
        //'allowedFileExtensions'=> ($model->document_type == 1) ? ['xls', 'xlsx', 'doc', 'docx'] : ['pdf'],
        //'showPreview' => true,
        'previewFileType' => 'any',
        'overwriteInitial' => true,
        'initialPreview' => [
            // "/uploads/docman/9001/" . $model->document->document_code. "/" . $model->filename,
            "/uploads/docman/9001/" 
                . $model->document->section->doccategory->folder . "/" 
                . $model->document->section->section_id . "/" 
                // . '1QM-DOST-IX-01-01.pdf',
                . $model->filename,
        ],
        'initialPreviewAsData'=>true,
        'initialPreviewConfig'=>[
            [
                'type' => "pdf", 
                'size' => 10000, 
                'caption' => $model->filename, 
                //'url' => Url::to(['request/deleteattachment']), 
                'key' => $model->doc_attachment_id]
        ],
        
        'fileActionSettings' => [
            'showDrag' => false,
            //'showZoom' => false,
            //'showUpload' => $model->request->owner() ? true : false,
            //'showDelete' => $model->request->owner() ? true : false,
        ],
        'uploadUrl' => Url::to(['uploads/']) 
    ]
]);

    echo Html::submitButton('Upload', [
        'class'=>$model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'float: right;']
    );


ActiveForm::end(); ?>
<br><br>
<script>
$(document).ready(function(){
    $(".fileinput-upload-button").hide();
    $(".kv-file-remove").hide();
});
</script>