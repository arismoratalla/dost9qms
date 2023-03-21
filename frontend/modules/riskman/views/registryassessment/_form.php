<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use kartik\editable\Editable; ;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $modelAssessment common\models\riskman\Registryassessment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registryassessment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelAssessment, 'registry_id')->hiddenInput()->label(false) ?>
    <?= $form->field($modelAction, 'registry_id')->hiddenInput()->label(false) ?>

    <div style="margin-top: -15px;" class="row">
        <div class="col-md-12">
            <div class="alert alert-<?= ($_GET['registry_type'] == 'Risk') ? 'warning' : 'success' ?>" >
                <span style="font-weight: bold; text-transform: uppercase; color: <?= ($_GET['registry_type'] == 'Risk') ? 'black' : 'success' ?>" class="alert-heading">
                <?= $_GET['registry_type']?> Details</span>
                <br><hr style="margin-top: -1px; margin-bottom: -1px; border-top: .5px solid <?= ($_GET['registry_type'] == 'Risk') ? 'black' : 'success' ?>;">
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4"> 
            
            <?= $form->field($modelAssessment, 'likelihood_id')->widget(Select2::classname(), [
                    'data' => $likelihood,
                    'id' => "likelihood",
                    'language' => 'en',
                    'options' => [
                        'placeholder' => 'Select Functional Unit',
                        // 'disabled' => true,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                    'pluginEvents'=>[
                        "change" => 'function() {
                            var likelihood = this.value;
                            var consequence_benefit = $("#registryassessment-benefit_consequence_id").val()
                            var evaluation = likelihood * consequence_benefit;
                            if(evaluation == NaN)
                            $("#registryassessment-evaluation").val(0);
                            else
                                $("#registryassessment-evaluation").val(evaluation);
                        }
                    ',]
            ])->label('Likelihood'); ?>
        </div>
        
        <div class="col-md-4"> 
                <?= $form->field($modelAssessment, 'benefit_consequence_id')->widget(Select2::classname(), [
                    'data' => $benefit_consequence,
                    'id' => "benefit_consequence",
                    'language' => 'en',
                    'options' => [
                        'placeholder' => 'Select Functional Unit',
                        // 'disabled' => true,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                    'pluginEvents'=>[
                        "change" => 'function() { 
                            var likelihood = $("#registryassessment-likelihood_id").val();
                            var consequence_benefit = this.value;
                            var evaluation = likelihood * consequence_benefit;
                            $("#registryassessment-evaluation").val(evaluation);
                        }
                    ',]
                ])->label(($_GET['registry_type'] == "Risk") ? 'Consequence' : 'Benefit'); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($modelAssessment, 'evaluation')->textInput(['readonly'=> true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12"> 
            <?= $form->field($modelAssessment, 'cause')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12"> 
            <?= $form->field($modelAssessment, 'effect')->textInput() ?>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6"> 
            <?= $form->field($modelAssessment, 'qtr')->textInput(['readonly'=> true]) ?>
            <?= $form->field($modelAction, 'qtr')->hiddenInput(['readonly'=> true])->label(false) ?>
        </div>
        
        <div class="col-md-6"> 
            <?= $form->field($modelAssessment, 'year')->textInput(['readonly'=> true]) ?>
            <?= $form->field($modelAction, 'year')->hiddenInput(['readonly'=> true])->label(false) ?>
        </div>
    
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                <span style="font-weight: bold;" class="alert-heading">Actions to <?= ($_GET['registry_type'] == 'Risk') ? 'Address the Risks' : 'Use the Opportunities'?></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6"> 
            <?= $form->field($modelAction, 'preventive_control_initiatives')
                ->textarea(['rows' => 1])->label(($_GET['registry_type'] == "Risk") ? 'Preventive Control' : 'Initiatives') ?>
        </div>
        
        <div class="col-md-6"> 
            <?= $form->field($modelAction, 'corrective_additional_action')
                ->textarea(['rows' => 1])->label(($_GET['registry_type'] == "Risk") ? 'Corrective Action' : 'Additional Action') ?>
        </div>

    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($modelAction, 'target_date_of_completion')->widget(DatePicker::classname(), [
                'readonly' => false,
                'disabled' => false,
                //'options' => ['placeholder' => 'Select Date'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label('Effectivity Date');?>
        </div>

        <div style="text-align: right; padding-top: 25px; padding-right: 35px;" class="col-md-6"> 
            <div class="form-group">
                <?= Html::submitButton($modelAssessment->isNewRecord ? '&nbsp;&nbsp;&nbsp;   Create   &nbsp;&nbsp;&nbsp;' : '&nbsp;&nbsp;&nbsp;   Update   &nbsp;&nbsp;&nbsp;', ['class' => $modelAssessment->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    


    

    <?php ActiveForm::end(); ?>

</div>
