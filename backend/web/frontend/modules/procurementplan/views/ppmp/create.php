<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\procurementplan\Ppmp */

$this->title = 'Create Ppmp';
$this->params['breadcrumbs'][] = ['label' => 'Ppmps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppmp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
