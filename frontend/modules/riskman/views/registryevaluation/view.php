<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryevaluation */

$this->title = $model->registry_evaluation_id;
$this->params['breadcrumbs'][] = ['label' => 'Registryevaluations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registryevaluation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->registry_evaluation_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->registry_evaluation_id], [
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
            'registry_evaluation_id',
            'registry_id',
            'evaluation',
            'year',
        ],
    ]) ?>

</div>
