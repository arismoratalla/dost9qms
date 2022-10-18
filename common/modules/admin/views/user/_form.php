<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\detail\DetailView;
use kartik\editable\Editable;
use kartik\grid\GridView;
use kartik\widgets\SwitchInput;
use kartik\widgets\DepDrop;

use common\models\docman\Division;
use common\models\docman\Functionalunit;
use common\models\docman\Position;
/* @var $this yii\web\View */
/* @var $model common\modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="panel panel-default col-xs-4">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Update User</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password_hash')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="panel panel-default col-xs-7" style="margin-left: 10px; padding-top: 15px;">
        <?php $attributes = [
            [
                'attribute'=>'lastname',
                'label'=>'Last Name',
                'inputContainer' => ['class'=>'col-sm-6'],
                // 'displayOnly'=>true
            ],
            [
                'attribute'=>'firstname',
                'label'=>'First Name',
                'inputContainer' => ['class'=>'col-sm-6'],
                // 'displayOnly'=>true
            ],
            [
                'attribute'=>'middleinitial',
                'label'=>'MI',
                'inputContainer' => ['class'=>'col-sm-6'],
                // 'displayOnly'=>true
            ],
            [
                'attribute'=>'designation',
                'label'=>'Designation',
                'inputContainer' => ['class'=>'col-sm-6'],
                // 'displayOnly'=>true
            ],
            [
                'attribute'=>'division_id',
                'label'=>'Division',
                'inputContainer' => ['class'=>'col-sm-6'],
                // 'displayOnly'=>true
                //'value' => $profile->division_id,
                // 'value' => function ($profile) { 
                //     return $profile->division_id;
                // },
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(Division::find()->all(),'division_id','name'),
                    'options' => [
                        'id'=>'division-id', 
                        'placeholder' => 'Select Division'
                    ],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
            ],
            [
                'attribute'=>'unit_id',
                'label'=>'Unit',
                'inputContainer' => ['class'=>'col-sm-6'],
                // 'displayOnly'=>true
                'value' => $profile->unit_id,
                'type'=>DetailView::INPUT_DEPDROP, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(Functionalunit::find()->one(),'functional_unit_id','name'),
                    'options' => [
                        'id'=>'functional_unit_id', 
                        'placeholder' => 'Select Unit'
                    ],
                    'pluginOptions' => [
                        'depends'=>['division-id'],
                        'allowClear'=>true, 
                        'width'=>'100%',
                        'url'=>Url::to(['user/listunit'])
                    ],
                ],
            ],
        ];?>

        <?= DetailView::widget([
                'model' => $model->profile,
                'mode'=>DetailView::MODE_VIEW,
                'container' => ['id'=>'kv-demo'],
                //'formOptions' => ['action' => Url::current(['#' => 'kv-demo'])] // your action to delete
                'buttons1' => ( (Yii::$app->user->identity->username == 'Admin') ) ? '{update}' : '', //hides buttons on detail view
                //'buttons1' => '{update}',
                'attributes' => $attributes,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,
                'formOptions' => ['action' => ['user/updateprofile', 'id' => $profile->profile_id]],
                'panel' => [
                    'heading'=>'USER DETAILS',
                    'type'=>DetailView::TYPE_PRIMARY,
                ],
            ]); ?>
    </div>


</div>


