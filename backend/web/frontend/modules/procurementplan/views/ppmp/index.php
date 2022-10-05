<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\procurementplan\PpmpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ppmps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppmp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ppmp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ppmp_id',
            'division_id',
            'charged_to',
            'project_id',
            'year',
            // 'end_user_id',
            // 'head_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
