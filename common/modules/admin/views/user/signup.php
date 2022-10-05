<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use kartik\select2\Select2;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\modules\admin\models\form\Signup */

$this->title = Yii::t('rbac-admin', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <?= $this->renderFile(__DIR__.'/../menu.php',['button'=>'user']); ?>
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Signup New User</div>
        <div class="panel-body">
    
    <p>Please fill out the following fields to signup:</p>
    <?= Html::errorSummary($model)?>
    <div class="row">
        <!--div class="col-lg-5"-->
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
               
               <span style="float:left; width: 45%;">
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                
                <?= $form->field($model, 'division_id')->widget(Select2::classname(), [
                    'data' => $listDivisions,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Division', 'id'=>'signup-division_id'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
                
                <?= $form->field($model, 'unit_id')->widget(DepDrop::classname(), [
                    'type'=>DepDrop::TYPE_SELECT2,
                    'options'=>['id'=>'unit_id'],
                    'pluginOptions'=>[
                        'depends'=>['signup-division_id'],
                        'placeholder'=>'Select Functional Unit',
                        'url'=>Url::to(['user/listunit'])
                    ]
                ]); ?>

                </span>
                
                <span style="float:right; width: 45%;">
                <?= $form->field($model, 'firstname') ?>
                <?= $form->field($model, 'lastname') ?>
                <?= $form->field($model, 'middleinitial') ?>
                <?= $form->field($model, 'designation')->widget(Select2::classname(), [
                    'data' => $listPositions,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Position'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
                <br/>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('rbac-admin', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
                </span>
                
                
                
            <?php ActiveForm::end(); ?>
        <!--/div-->
    </div>
        </div>
    </div>
</div>
