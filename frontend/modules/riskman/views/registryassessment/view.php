<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryassessment */

$this->title = $model->registry_assessment;
$this->params['breadcrumbs'][] = ['label' => 'Registryassessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registryassessment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->registry_assessment], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->registry_assessment], [
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
            'registry_assessment',
            'registry_id',
            'likelihood_id',
            'benefit_consequence_id',
            'evaluation',
            'qrt',
            'year',
        ],
    ]) ?>

</div>
