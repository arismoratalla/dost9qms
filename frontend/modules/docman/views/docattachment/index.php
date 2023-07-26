<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\docman\DocattachmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Docattachments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docattachment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Docattachment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'doc_attachment_id',
            'doc_id',
            'filename',
            'document_type',
            'last_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
