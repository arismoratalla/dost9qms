<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\riskman\RegistryactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registryactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registryaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Registryaction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'registry_action_id',
            'registry_id',
            'preventive_control_initiatives',
            'corrective_additional_action',
            'target_date_of_completion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
