<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\docman\DocSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'doc_id') ?>

    <?= $form->field($model, 'section_id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'effectivity_date') ?>

    <?php // echo $form->field($model, 'revision_num') ?>

    <?php // echo $form->field($model, 'person_responsible') ?>

    <?php // echo $form->field($model, 'copy_holder') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
