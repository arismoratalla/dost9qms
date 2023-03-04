<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryevaluation */

$this->title = 'Create Registryevaluation';
$this->params['breadcrumbs'][] = ['label' => 'Registryevaluations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registryevaluation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
