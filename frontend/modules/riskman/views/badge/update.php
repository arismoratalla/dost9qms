<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Badge */

$this->title = 'Update Badge: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Badges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->badge_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="badge-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
