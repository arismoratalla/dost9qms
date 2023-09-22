<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Issuance */

$this->title = $model->issuance_id;
$this->params['breadcrumbs'][] = ['label' => 'Issuances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issuance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->issuance_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->issuance_id], [
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
            'issuance_id',
            'issuance_type_id',
            'code',
            'subject:ntext',
            'file',
            'date',
        ],
    ]) ?>

</div>
