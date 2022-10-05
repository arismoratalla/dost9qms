<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Package */

$this->title = 'Update Package: ' . ucwords($model->PackageName);
$this->params['breadcrumbs'][] = ['label' => 'Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => ucwords($model->PackageName), 'url' => ['view', 'id' => $model->PackageID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="package-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
