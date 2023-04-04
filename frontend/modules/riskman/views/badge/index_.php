<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\riskman\BadgeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Badges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="badge-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Badge', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'badge_id',
            'module_id',
            'name',
            'description',
            'criteria',
            // 'award_type',
            // 'icon',
            // 'date_created',
            // 'date_modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
