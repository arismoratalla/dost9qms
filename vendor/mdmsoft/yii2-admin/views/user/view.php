<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
?>
<div class="user-view">
<?= $this->renderFile(__DIR__.'/../menu.php',['button'=>'user']); ?>
<div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> View</div>
        <div class="panel-body">
   <p>
        <?php
        if ($model->status == 0 && Helper::checkRoute($controllerId . 'activate')) {
            echo Html::a(Yii::t('rbac-admin', 'Activate'), ['activate', 'id' => $model->id], [
                'class' => 'btn btn-primary',
                'data' => [
                    'confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                    'method' => 'post',
                ],
            ]);
        }else{
            echo Html::a(Yii::t('rbac-admin', 'Deactivate'), ['deactivate', 'id' => $model->id], [
                        'class' => 'btn btn-primary',
                        'data' => [
                            'confirm' => Yii::t('rbac-admin', 'Are you sure you want to Deactivate this user?'),
                            'method' => 'post',
                        ],
                    ]); 
                }
        ?>
        <?php
        if (Helper::checkRoute($controllerId . 'delete')) {
            echo Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        }
        echo "&nbsp;".Html::a("Update", Url::to(['user/update','id'=>$model->id]),['class'=>'btn btn-primary']);
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return gmdate("m/d/Y H:i A", $model->created_at); 
                }, 
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return gmdate("m/d/Y H:i A", $model->updated_at); 
                }, 
            ],
            [
                'attribute'=>'status',
                'value'=>$model->status==10 ? 'Active' : 'Inactive'
            ],
        ],
    ])
    ?>
        </div>
</div>

</div>
