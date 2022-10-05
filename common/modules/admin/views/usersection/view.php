<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\system\Usersection */

$this->title = $model->user_section_id;
$this->params['breadcrumbs'][] = ['label' => 'Usersections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usersection-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_section_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_section_id], [
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
            'user_section_id',
            'user_id',
            'section_id',
            'access',
        ],
    ]) ?>

</div>
