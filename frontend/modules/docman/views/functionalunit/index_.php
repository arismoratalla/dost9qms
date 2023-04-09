<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\docman\FunctionalunitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Functionalunits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="functionalunit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Functionalunit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'functional_unit_id',
            'division_id',
            'qms_type_id',
            'name',
            'code',
            // 'unit_head',
            // 'num',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
