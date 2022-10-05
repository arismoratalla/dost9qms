<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\sec\BlockchainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blockchains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blockchain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blockchain', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'blockchain_id',
            'index_id',
            'scope',
            'timestamp:datetime',
            'data',
            // 'previoushash',
            // 'hash',
            // 'nonce',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
