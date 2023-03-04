<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryassessment */

$this->title = 'Update Registryassessment: ' . $model->registry_assessment;
$this->params['breadcrumbs'][] = ['label' => 'Registryassessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->registry_assessment, 'url' => ['view', 'id' => $model->registry_assessment]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registryassessment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
