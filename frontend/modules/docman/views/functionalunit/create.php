<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\docman\Functionalunit */

$this->title = 'Create Functionalunit';
$this->params['breadcrumbs'][] = ['label' => 'Functionalunits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="functionalunit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
