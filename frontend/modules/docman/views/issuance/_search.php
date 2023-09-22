<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\docman\IssuanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="issuance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'issuance_id') ?>

    <?= $form->field($model, 'issuance_type') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'subject') ?>

    <?= $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
