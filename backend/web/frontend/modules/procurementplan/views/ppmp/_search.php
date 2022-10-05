<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\procurementplan\PpmpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ppmp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ppmp_id') ?>

    <?= $form->field($model, 'division_id') ?>

    <?= $form->field($model, 'charged_to') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'end_user_id') ?>

    <?php // echo $form->field($model, 'head_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
