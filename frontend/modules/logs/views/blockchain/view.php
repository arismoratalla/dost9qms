<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\sec\Blockchain */

$this->title = $model->blockchain_id;
$this->params['breadcrumbs'][] = ['label' => 'Blockchains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blockchain-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->blockchain_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->blockchain_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'blockchain_id',
            'index_id',
            'scope',
            'timestamp:datetime',
            'data',
            'previoushash',
            'hash',
            'nonce',
            'user_id',
        ],
    ]) ?>

</div>
