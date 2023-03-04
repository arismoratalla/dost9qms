<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registryaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'registry_id')->textInput() ?>

    <?= $form->field($model, 'preventive_control_initiatives')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'corrective_additional_action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target_date_of_completion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
