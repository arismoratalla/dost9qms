<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\procurementplan\Ppmp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ppmp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'division_id')->textInput() ?>

    <?= $form->field($model, 'charged_to')->textInput() ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'end_user_id')->textInput() ?>

    <?= $form->field($model, 'head_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
