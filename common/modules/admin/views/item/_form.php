<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\admin\components\RouteRule;
use common\modules\admin\AutocompleteAsset;
use yii\helpers\Json;
use common\modules\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$rules = Configs::authManager()->getRules();
unset($rules[RouteRule::RULE_NAME]);
$source = Json::htmlEncode(array_keys($rules));

$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    });
JS;
AutocompleteAsset::register($this);
$this->registerJs($js);
?>

<div class="auth-item-form">
    <?= $this->renderFile(__DIR__ . '/../menu.php', ['button' => $labels['Items']]); ?>
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-md fa-adn"></i> <?= $this->title ?></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'item-form']); ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'ruleName')->textInput(['id' => 'rule_name']) ?>

                    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>
                </div>
            </div>
            <div class="form-group">
                <?php
                echo Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), [
                    'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                    'name' => 'submit-button'])
                ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
