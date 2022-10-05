<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Package */
/* @var $form yii\widgets\ActiveForm */
$FontAwesomeList=FA::getConstants();

?>

<div class="package-form">
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Update Package <?= ucwords($model->PackageName) ?></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'PackageName')->textInput(['maxlength' => true,'readonly'=>true]) ?>
             <?= $form->field($model, 'icon')->widget(Select2::classname(), [
                'data' => $FontAwesomeList,
                'language' => 'en',
                'options' => ['placeholder' => 'Select Icon'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
