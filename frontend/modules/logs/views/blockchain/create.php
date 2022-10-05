<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\sec\Blockchain */

$this->title = 'Create Blockchain';
$this->params['breadcrumbs'][] = ['label' => 'Blockchains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blockchain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
