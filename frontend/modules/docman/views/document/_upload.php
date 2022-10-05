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
        //'allowedFileExtensions'=>['pdf', 'xls', 'doc', 'docx', 'ppt'],
        'allowedFileExtensions'=> ($model->document_type == 1) ? ['xls', 'xlsx', 'doc', 'docx'] : ['pdf'],
        //'showPreview' => true,
        'previewFileType' => 'any',
        'overwriteInitial' => true,
        //'initialPreview' =>[Requestattachment::checkFile($model->attachment_id)],
        'initialPreview' => [
            "/uploads/docman/document/" . $model->document->document_code. "/" . $model->filename,
        ],
        'initialPreviewAsData'=>true,
        'initialPreviewConfig'=>[
            [
                'type' => "pdf", 
                'size' => 10000, 
                'caption' => $model->document->filename, 
                //'url' => Url::to(['request/deleteattachment']), 
                'key' => $model->document_attachment_id]
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

//if($model->request->owner()){
    echo Html::submitButton('Upload', [
        'class'=>$model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'float: right;']
    );
//}

//if(Yii::$app->user->can('access-finance-verification') || (Yii::$app->user->identity->username == 'Admin')){
    /*echo Html::submitButton('Mark as VERIFIED', [
        'class'=>'btn btn-primary', 'style' => 'float: right;']
    );*/
    
    //echo Html::button('Mark as VERIFIED', ['value' => Url::to(['request/markverified', 'id'=>$model->request_attachment_id]), 'title' => 'Mark as Verified', 'class' => 'btn btn-info', 'style'=>'margin-right: 6px; float: right;', 'id'=>'buttonMarkVerify']);
//}

ActiveForm::end(); ?>

<?php 
/*if( !$model->status_id && (Yii::$app->user->can('access-finance-verification') || (Yii::$app->user->identity->username == 'Admin')) ){

    $form2 = ActiveForm::begin([
        'action' => ['request/markverified?id='.$model->request_attachment_id],
        'options' => [
            'class' => 'mark-as-verified'
        ]
    ]);*/
    ?>

    <!--?= Html::submitButton('Mark as VERIFIED', ['class' => 'btn btn-primary', 'style' => 'float: right;', ]); ?-->

<?php
    
//ActiveForm::end(); 

//}
?>
<br><br>

<script>
$(document).ready(function(){
    $(".fileinput-upload-button").hide();
    //$(".file-caption").change(function(){
        //alert($(".file-caption-name").prop('title'));
    //});
});
</script>