<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registry */

$this->title = 'Create Registry';
$this->params['breadcrumbs'][] = ['label' => 'Registries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
