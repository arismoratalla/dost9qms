<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title="Verified";

?>

<div class="container registration">
    <div class="full-width">
        <div class="banner-success-wrapper">
            <div class="logo">
                <img src="<?= $GLOBALS['base_uri'] ?>images/logo.png">
            </div> 
            <h1 class="banner-success verify">Account successfully Verified</h1>
            <code>You have been assigned the default role 'basic-role' Please wait for the administrator to assign you additional role and permissions.</code>
            <hr style="padding-bottom: 5px;padding-top: 0px;margin-bottom: 0px;margin-top: 5px">
            <div class="centered">
                <a href="<?= $GLOBALS['base_uri'] ?>site/login" class="button"> Login to Dashboard </a>
            </div>
        </div>
    </div>
</div>
