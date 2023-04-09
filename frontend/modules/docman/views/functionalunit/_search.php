<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\docman\FunctionalunitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="functionalunit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'functional_unit_id') ?>

    <?= $form->field($model, 'division_id') ?>

    <?= $form->field($model, 'qms_type_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'unit_head') ?>

    <?php // echo $form->field($model, 'num') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
