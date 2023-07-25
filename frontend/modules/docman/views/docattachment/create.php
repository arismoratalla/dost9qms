<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\docman\Docattachment */

$this->title = 'Create Docattachment';
$this->params['breadcrumbs'][] = ['label' => 'Docattachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docattachment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
