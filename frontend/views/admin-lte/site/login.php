<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b><span style="color:indianred;">Finance</span></b> and <b><span style="color: #0d6aad;">Administrative</span></b> Information Management System</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"></p>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
        <h5 data-step="1" data-intro="Type your username here or email!">
        <?= $form
            ->field($model, 'email', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        </h5>

        <h5 data-step="2" data-intro="Type your correct password here!">
        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
        </h5>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <h5 data-step="3" data-intro="Click the Sign in Button">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button']) ?>
                </h5>
            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>
        <a href="/site/requestpasswordreset">Forgot Password</a><br>
        <!--a href="/site/signup">Sign Up</a><br-->
        <a id="startButton"  href="javascript:void(0);">Show me how</a>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

<script type="text/javascript">
    document.getElementById('startButton').onclick = function() {
        introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
            window.location.href = 'index?multipage=true';
        });
    };
</script>
