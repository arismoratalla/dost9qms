<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\sec\BlockchainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blockchain-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'blockchain_id') ?>

    <?= $form->field($model, 'index_id') ?>

    <?= $form->field($model, 'scope') ?>

    <?= $form->field($model, 'timestamp') ?>

    <?= $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'previoushash') ?>

    <?php // echo $form->field($model, 'hash') ?>

    <?php // echo $form->field($model, 'nonce') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
