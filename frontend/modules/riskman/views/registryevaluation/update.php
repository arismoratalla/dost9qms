<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryevaluation */

$this->title = 'Update Registryevaluation: ' . $model->registry_evaluation_id;
$this->params['breadcrumbs'][] = ['label' => 'Registryevaluations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->registry_evaluation_id, 'url' => ['view', 'id' => $model->registry_evaluation_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registryevaluation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
