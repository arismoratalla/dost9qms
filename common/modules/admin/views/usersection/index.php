<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\system\UsersectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usersections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usersection-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usersection', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_section_id',
            'user_id',
            'section_id',
            'access',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
