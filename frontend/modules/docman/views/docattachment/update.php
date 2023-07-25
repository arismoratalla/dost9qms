<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\docman\Docattachment */

$this->title = 'Update Docattachment: ' . $model->doc_attachment_id;
$this->params['breadcrumbs'][] = ['label' => 'Docattachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->doc_attachment_id, 'url' => ['view', 'id' => $model->doc_attachment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="docattachment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
