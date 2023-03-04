<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\RegistryactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registryaction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'registry_action_id') ?>

    <?= $form->field($model, 'registry_id') ?>

    <?= $form->field($model, 'preventive_control_initiatives') ?>

    <?= $form->field($model, 'corrective_additional_action') ?>

    <?= $form->field($model, 'target_date_of_completion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
