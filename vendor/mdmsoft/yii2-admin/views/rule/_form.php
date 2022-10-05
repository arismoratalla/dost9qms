<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this  yii\web\View */
/* @var $model mdm\admin\models\BizRule */
/* @var $form ActiveForm */
?>

<div class="auth-item-form">
    <?= $this->renderFile(__DIR__ . '/../menu.php', ['button' => 'rule']); ?>
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-reorder"></i> Create/Update Rule</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
            <?= $form->field($model, 'className')->textInput() ?>
            <div class="form-group">
                <?php
                echo Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), [
                    'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
                ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
