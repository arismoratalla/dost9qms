<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\documentmanagement\Document */

$this->title = 'Update Document: ' . $model->document_id;
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->document_id, 'url' => ['view', 'id' => $model->document_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="document-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
