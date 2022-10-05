<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\procurementplan\Ppmp */

$this->title = $model->ppmp_id;
$this->params['breadcrumbs'][] = ['label' => 'Ppmps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppmp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ppmp_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ppmp_id], [
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
            'ppmp_id',
            'division_id',
            'charged_to',
            'project_id',
            'year',
            'end_user_id',
            'head_id',
        ],
    ]) ?>

</div>
