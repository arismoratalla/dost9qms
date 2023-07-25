<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Docattachment */

$this->title = $model->doc_attachment_id;
$this->params['breadcrumbs'][] = ['label' => 'Docattachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docattachment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->doc_attachment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->doc_attachment_id], [
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
            'doc_attachment_id',
            'doc_id',
            'filename',
            'document_type',
            'last_update',
        ],
    ]) ?>

</div>
