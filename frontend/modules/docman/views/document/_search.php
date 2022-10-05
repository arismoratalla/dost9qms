<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\documentmanagement\DocumentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'document_id') ?>

    <?= $form->field($model, 'subject') ?>

    <?= $form->field($model, 'filename') ?>

    <?= $form->field($model, 'document_code') ?>

    <?= $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'functional_unit_id') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'revision_number') ?>

    <?php // echo $form->field($model, 'effectivity_date') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
