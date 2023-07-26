<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Doc */

$this->title = 'Update Doc: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->doc_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
