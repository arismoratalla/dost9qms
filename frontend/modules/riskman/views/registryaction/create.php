<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryaction */

$this->title = 'Create Registryaction';
$this->params['breadcrumbs'][] = ['label' => 'Registryactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registryaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
