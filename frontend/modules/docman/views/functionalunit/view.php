<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Functionalunit */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Functionalunits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="functionalunit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->functional_unit_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->functional_unit_id], [
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
            'functional_unit_id',
            'division_id',
            'qms_type_id',
            'name',
            'code',
            'unit_head',
            'num',
        ],
    ]) ?>

</div>
