<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registry */

$this->title = 'Update Registry: ' . $model->registry_id;
$this->params['breadcrumbs'][] = ['label' => 'Registries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->registry_id, 'url' => ['view', 'id' => $model->registry_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registry-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
