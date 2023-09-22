<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use kartik\editable\Editable; ;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Issuance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="issuance-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6"> 
            <?= $form->field($model, 'issuance_type_id')->widget(Select2::classname(), [
                'data' => $types,
                'language' => 'en',
                'options' => ['placeholder' => 'Select Category'],
                'pluginOptions' => [
                    'allowClear' => false
                ],
                // 'pluginEvents'=>[
                //     "change" => 'function() { 
                //         var categoryId=this.value;
                //         if((categoryId == 4) || (categoryId == 5)){
                //             $("#document-functional_unit_id").prop("disabled", false);
                //         }else{
                //             $("#document-functional_unit_id").prop("disabled", "disabled");
                //         }
                //     }
                // ',]
            ])->label('Issuance Type'); ?>
        </div>
        
        <div class="col-md-6"> 
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
    
    </div>

    <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'subject')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date')->widget(DateTimePicker::classname(), [
                // 'readonly' => true,
                // 'disabled' => true,
                'options' => ['placeholder' => 'Select Date'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ])->label('Date');?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>
    </div>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
