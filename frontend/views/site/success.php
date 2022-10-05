<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title="Registration Successul";
?>

<div class="container registration">
    <div class="full-width">
        <div class="banner-success-wrapper">
            <h3 style="width: 100%;text-align:center">Hi <?= $model->username ?>!</h3>
            <h1 class="banner-success" style="width: 100%;text-align:center">Signed Up Successful</h1>
            <h4 style="text-align: center">Please check your email: <strong><?= $model->email ?></strong> to verify your account.</h4>
        </div>
    </div>
</div>
