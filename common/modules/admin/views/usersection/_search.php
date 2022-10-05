<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\system\UsersectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usersection-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_section_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'section_id') ?>

    <?= $form->field($model, 'access') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
