<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Issuance */

$this->title = 'Update Issuance: ' . $model->issuance_id;
$this->params['breadcrumbs'][] = ['label' => 'Issuances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->issuance_id, 'url' => ['view', 'id' => $model->issuance_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="issuance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
