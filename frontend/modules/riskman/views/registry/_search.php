<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\RegistrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registry-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'registry_id') ?>

    <?= $form->field($model, 'registry_type') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'unit_id') ?>

    <?= $form->field($model, 'group_id') ?>

    <?php // echo $form->field($model, 'stakeholders') ?>

    <?php // echo $form->field($model, 'customer_requirement') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
