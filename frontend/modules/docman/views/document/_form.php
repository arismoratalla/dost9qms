<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use kartik\editable\Editable; ;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;

use common\models\docman\Category;
use common\models\docman\Functionalunit;
/* @var $this yii\web\View */
/* @var $model common\models\documentmanagement\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        
        <div class="col-md-6"> 
                <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Category::find()->all(),'category_id','name'),
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Category'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                    'pluginEvents'=>[
                        "change" => 'function() { 
                            var categoryId=this.value;
                            $.post("/docman/document/updateunits/", 
                                {
                                    categoryId: categoryId
                                }, 
                                function(response){
                                    if(response){
                                       $("#document-content").val(response.default_text);
                                    }
                                }
                            );
                        }
                    ',]
                ])->label('Cetegory'); ?>
        </div>
        
        <div class="col-md-6"> 
                <?= $form->field($model, 'functional_unit_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Functionalunit::find()->all(),'functional_unit_id','name'),
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Functional Unit'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                    'pluginEvents'=>[
                        "change" => 'function() { 
                            var categoryId=this.value;
                            $.post("/docman/document/updateunits/", 
                                {
                                    categoryId: categoryId
                                }, 
                                function(response){
                                    if(response){
                                       $("#document-content").val(response.default_text);
                                    }
                                }
                            );
                        }
                    ',]
                ])->label('Unit'); ?>
        </div>
    
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
            <?= $form->field($model, 'subject')->textInput(['maxlength' => true])->label('Document Name') ?>
        </div>
        

        
    </div>
    
    <div class="row">

        <div class="col-md-12">
            <?= $form->field($model, 'document_code')->textInput(['maxlength' => true]) ?>
        </div>
        
    </div>
    
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'revision_number')->textInput() ?>
        </div>
        
        <div class="col-md-6">
            <?= $form->field($model, 'effectivity_date')->widget(DatePicker::classname(), [
                'readonly' => false,
                'disabled' => false,
                'options' => ['placeholder' => 'Select Date'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label('Effectivity Date');?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <!--?= $form->field($model, 'is_form')->checkBox(['label' => '  This is a Form', 'uncheck' => true]); ?-->
        </div>
    </div>
    




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
