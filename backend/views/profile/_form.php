<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\system\User;
use yii\helpers\ArrayHelper;
//use common\models\Rstl;
//use common\models\Lab;
use cozumel\cropper\ImageCropper;
use kartik\widgets\FileInput;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
if(Yii::$app->user->can('access-his-profile')){
    $UserList= ArrayHelper::map(User::findAll(['user_id'=>Yii::$app->user->identity->user_id]),'user_id','email');
}else{
    $UserList= ArrayHelper::map(User::find()->all(),'user_id','email');
}
$UserList= ArrayHelper::map(User::find()->all(),'user_id','email');
$DivisionList= ArrayHelper::map(Division::find()->all(),'id','name');
//$LabList= ArrayHelper::map(lab::find()->all(),'lab_id','labname');
$js =<<< SCRIPT
   $('#profileImage_upload').on('fileclear', function(event) {
      $('#profile-image_url').val('');
      $('#profile-avatar').val('');
   });      
SCRIPT;
$this->registerJs($js, View::POS_READY)
?>

<div class="profile-form">
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Update <?= $model->firstname ?></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'options'=>['enctype'=>'multipart/form-data'] // important
            ]); ?>
            <div class="row">
                <span style="float:left; width: 250px;margin-right: 5px">
                <?php echo $form->field($model, 'image_url')->hiddenInput(['value' => $model->image_url])->label(false) ?>
                <?php echo $form->field($model, 'avatar')->hiddenInput(['value' => $model->avatar])->label(false) ?>
                <?php
                    // your fileinput widget for single file upload
                    echo $form->field($model, 'image')->widget(FileInput::classname(), [
                        'options'=>[
                            'id'=>'profileImage_upload',
                            'accept'=>'image/*'
                        ],
                        'pluginOptions'=>[
                            'allowedFileExtensions'=>['jpg','gif','png'],
                            'overwriteInitial'=>true,
                            'initialPreview' => [
                                '<img src="'.$GLOBALS['upload_url'].$model->getImageUrl().'" width="200" class="file-preview-image">',
                            ],
                            'showUpload'=>false,
                            'showRemove'=>true,
                        ],
                        //'value'=>Yii::$app->basePath.'\web\uploads\user\photo\\'.$model->avatar
                        ])->label(false);
                ?>
                </span>
            </div>
            <div class="row">
            <span style="float:left; width: 250px;margin-right: 5px">
            <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
                'data' => $UserList,
                'language' => 'en',
                'options' => ['placeholder' => 'Select Email'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Email'); ?>
            </span>
            <span style="float:left; width: 250px;margin-right: 5px">
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
            </span>
            </div>
            <div class="row">
            <span style="float:left; width: 250px;margin-right: 5px">
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
            </span>
            <span style="float:left; width: 250px;margin-right: 5px">
            <?= $form->field($model, 'middleinitial')->textInput(['maxlength' => true]) ?>
            </span>
            </div>
            <div class="row">
            <span style="float:left; width: 250px;margin-right: 5px">
            <?= $form->field($model, 'designation')->textInput() ?>
            </span>
            <span style="float:left; width: 250px;margin-right: 5px">
            <?= $form->field($model, 'contact_numbers')->textInput() ?>
            </span>
            </div>
            <div class="row">
            <span style="float:left; width: 250px;margin-right: 5px">
            <?= $form->field($model, 'division_id')->widget(Select2::classname(), [
                'data' => $DivisionList,
                'language' => 'en',
                'options' => ['placeholder' => 'Select Division'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            </span>
            <span style="float:left; width: 250px;margin-right: 5px">
            <!--?= $form->field($model, 'lab_id')->widget(Select2::classname(), [
                'data' => $LabList,
                'language' => 'en',
                'options' => ['placeholder' => 'Select Lab'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);  ?-->
            </span>
            </div>
            <div class="row">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

