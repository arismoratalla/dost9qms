<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\RegistryassessmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registryassessment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'registry_assessment') ?>

    <?= $form->field($model, 'registry_id') ?>

    <?= $form->field($model, 'likelihood_id') ?>

    <?= $form->field($model, 'benefit_consequence_id') ?>

    <?= $form->field($model, 'evaluation') ?>

    <?php // echo $form->field($model, 'qrt') ?>

    <?php // echo $form->field($model, 'year') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
