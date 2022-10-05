<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = 'Create Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
