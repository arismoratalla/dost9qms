<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryaction */

$this->title = 'Update Registryaction: ' . $model->registry_action_id;
$this->params['breadcrumbs'][] = ['label' => 'Registryactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->registry_action_id, 'url' => ['view', 'id' => $model->registry_action_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registryaction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
