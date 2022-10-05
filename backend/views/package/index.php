<?php

/* 
 * Project Name: eulims * 
 * Copyright(C)2018 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 01 8, 18 , 4:37:25 PM * 
 * Module: default * 
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Package List';
$this->params['breadcrumbs'][] = $this->title;
$Buttontemplate='{view}{update}';
?>
<div class="package-index">
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-angellist"></i> <?= $this->title ?> View</div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'PackageName',
                        'label' => 'PackageName',
                        'value' => function($model) {
                            return ucwords($model->PackageName);
                        }
                    ],
                    [
                        'attribute' => 'icon',
                        'label' => 'Icon',
                        'format' => 'raw',
                        'value' => function($model) {
                            return "<span class='" . $model->icon . "'><span>";
                        }
                    ],
                    'created_at:date',
                    'updated_at:date',
                    [
                        //'class' => 'yii\grid\ActionColumn'
                        'class' => ActionColumn::className(),
                        'template'=>$Buttontemplate,
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
