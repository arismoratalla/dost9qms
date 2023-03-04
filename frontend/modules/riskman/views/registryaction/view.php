<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryaction */

$this->title = $model->registry_action_id;
$this->params['breadcrumbs'][] = ['label' => 'Registryactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registryaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->registry_action_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->registry_action_id], [
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
            'registry_action_id',
            'registry_id',
            'preventive_control_initiatives',
            'corrective_additional_action',
            'target_date_of_completion',
        ],
    ]) ?>

</div>
