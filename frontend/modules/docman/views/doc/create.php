<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\docman\Doc */

$this->title = 'Create Doc';
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
