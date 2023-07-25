<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Doc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'section_id')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'effectivity_date')->textInput() ?>

    <?= $form->field($model, 'revision_num')->textInput() ?>

    <?= $form->field($model, 'person_responsible')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'copy_holder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
