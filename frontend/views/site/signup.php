<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$js=<<<SCRIPT
   $("#btnSubmit").click(function(){
        $("#bootstrapprogress").removeClass("hidden");
   });
SCRIPT;
$this->registerJs($js);
?>
<div class="site-signup">
    <div class="panel panel-default">
        <div class="panel-body" style="margin-bottom: 0px">
            <h1><i class="fa fa-address-book"></i> <?= Html::encode($this->title) ?></h1>
            <p style="margin-bottom: 0px">Please fill out the following fields to signup and wait for the confirmation email:</p>
            <div id="bootstrapprogress" class="progress hidden" style="margin-bottom: 0px">
                <div class="progress-bar progress-bar-striped progress-bar-animated active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Submitting Request...</div>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button','id'=>'btnSubmit']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
