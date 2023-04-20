<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use kartik\editable\Editable; ;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $modelRegistry common\models\riskman\Registry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registry-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        
        <div class="col-md-6"> 
            
            <?= $form->field($modelRegistry, 'registry_type')
                ->dropDownList([ 'Risk' => 'Risk', 'Opportunity' => 'Opportunity', ]) ?>
        </div>
        
        <div class="col-md-6"> 
                <?= $form->field($modelRegistry, 'unit_id')->widget(Select2::classname(), [
                    'data' => $units,
                    'language' => 'en',
                    'options' => [
                        'placeholder' => 'Select Functional Unit',
                        'disabled' => $disabled,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ])->label('Unit'); ?>
        </div>
    
    </div>

    <div class="row">
        
        <div class="col-md-6"> 
            <?= $form->field($modelRegistry, 'area_id')->widget(Select2::classname(), [
                    'data' => $areas,
                    'language' => 'en',
                    'options' => [
                        'placeholder' => 'Select Area',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                    'pluginEvents'=>[
                        "change" => 'function() { 
                            var areaId=this.value;
                            if(areaId == 7){
                                $("#registry-sub_area").prop("disabled", false);
                            }else{
                                $("#registry-sub_area").prop("disabled", "disabled");
                            }
                        }
                    ',]
                ])->label('Area'); ?>
        </div>

        <div class="col-md-6"> 
            
            <?= $form->field($modelRegistry, 'sub_area')
                ->dropDownList(['National' => 'National', 'Regional' => 'Regional', 'Local' => 'Local'], ['disabled' => 'disabled', 'allowClear' => true]) ?>
        </div>
           
    </div>

    <div class="row">
        <div class="col-md-6"> 
            <?= $form->field($modelRegistry, 'source_id')->widget(Select2::classname(), [
                'data' => $sources,
                'language' => 'en',
                'options' => [
                    'placeholder' => 'Select Registry Source',
                    // 'disabled' => true,
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])->label('Source'); ?>
        </div>
        <div class="col-md-6"> 
            <?= $form->field($modelRegistry, 'stakeholders')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12"> 
            <?= $form->field($modelRegistry, 'potential')->textarea(['rows' => 2]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                <span style="font-weight: bold;" class="alert-heading">Monitoring Plan</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6"> 
            <?= $form->field($modelRegistrymonitoring, 'frequency')->textInput() ?>
        </div>

        <div class="col-md-6"> 
            <?= $form->field($modelRegistrymonitoring, 'monitoring_team')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($modelRegistrymonitoring, 'target_date')->widget(DatePicker::classname(), [
                'readonly' => false,
                'disabled' => false,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label('Target Date');?>
        </div>
        
        <div style="text-align: right; padding-top: 25px; padding-right: 25px;" class="col-md-6"> 
            <div class="form-group">
                <!--?= Html::submitButton($modelRegistry->isNewRecord ? 'Create' : 'Update', ['class' => $modelRegistry->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?-->
                <?= Html::submitButton($modelRegistry->isNewRecord ? 'Create' : ucfirst(Yii::$app->controller->action->id), 
                        [   'class' => $modelRegistry->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                            'style' => 'width: 120px; border-radius: 10px;',
                            'id'=>'submitDraft',
                        ]) ?>
            </div>
        </div>
    </div>

    

    <?php ActiveForm::end(); ?>

</div>

<script>
$(".registry-form").on("beforeSubmit",function(e){
    e.preventDefault();
    $("#submitDraft").css({pointerEvents:'none'});
    return true;
});

</script>