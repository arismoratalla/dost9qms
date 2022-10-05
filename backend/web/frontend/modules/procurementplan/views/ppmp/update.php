<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\procurementplan\Ppmp */

$this->title = 'Update Ppmp: ' . $model->ppmp_id;
$this->params['breadcrumbs'][] = ['label' => 'Ppmps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ppmp_id, 'url' => ['view', 'id' => $model->ppmp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ppmp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
