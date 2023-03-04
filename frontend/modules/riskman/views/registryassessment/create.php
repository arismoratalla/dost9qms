<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\riskman\Registryassessment */

$this->title = 'Create Registryassessment';
$this->params['breadcrumbs'][] = ['label' => 'Registryassessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registryassessment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelAssessment' => $modelAssessment,
        //'modelAction' => $modelAction,
    ]) ?>

</div>
