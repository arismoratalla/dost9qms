<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\sec\Blockchain */

$this->title = 'Update Blockchain: ' . $model->blockchain_id;
$this->params['breadcrumbs'][] = ['label' => 'Blockchains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->blockchain_id, 'url' => ['view', 'id' => $model->blockchain_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blockchain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
