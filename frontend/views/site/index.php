<?php
use yii\web\JsExpression;
use yii\helpers\Url;
use edofre\fullcalendar\Fullcalendar;
/* @var $this yii\web\View */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">
    <?php if(!Yii::$app->user->isGuest){ ?>
    <div class="body-content">
        <div class="row-fluid">
        </div>
    </div>
    <?php }else{ ?>
    <div class="body-content">
        <div class="row-fluid">
            <div class="jumbotron-carousel">
                <h3>Enhaced FAIS version 1.0</h3>
            </div>
        </div>
    </div>
    <?php } ?>
</div>