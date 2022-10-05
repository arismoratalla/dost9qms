<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\file\FileInput;
use yii\helpers\Url;
use budyaga\cropper\Widget;
use yii\widgets\ActiveForm;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\bootstrap\Modal;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = $model->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['/profile']];
$this->params['breadcrumbs'][] = $this->title;
$path = Yii::getAlias("@webroot")."\uploads\user\photo\\";
Modal::begin([
    'header' => '<h3 style="margin-top: 0px;margin-bottom: 0px">'.$model->user->profile->firstname.' '.$model->user->profile->lastname.'</h3><br style="margin-top: 0px;margin-bottom: 0px">'.$model->user->profile->designation,
    'size'   => 'model-big',
    //'toggleButton' => ['label' => 'click me'],
]);
echo Html::img(Yii::$app->urlManagerBackend->baseUrl.'\uploads\user\photo\\'.$model->getImageUrl(), [ 
                    'class' => 'img-thumbnail img-responsive',
                    'alt' => $model->user->username,
                    'width'=>400
                ]) ;
Modal::end();
?>

<div class="profile-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->profile_id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->can('can-delete-profile')){ ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->profile_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> View</div>
        <div class="panel-body">
            <div class="col-md-2">
               <?= Html::img('/images/user/photo/'.$model->getImageUrl(), [ 
                    'class' => 'img-thumbnail img-responsive',
                    'alt' => $model->user->username,
                    'width'=>200,
                    'data-toggle'=>'modal',
                    'data-target'=>'#w0'
                ]) 
                ?>
            </div>
            
            <div class="col-md-2">
               <?= Html::img('/images/user/signature/'.$model->getSignatureUrl(), [ 
                    'class' => 'img-thumbnail img-responsive',
                    'alt' => $model->user->username,
                    'width'=>200,
                    'data-toggle'=>'modal',
                    'data-target'=>'#w0'
                ]) 
                ?>
            </div>
            
            <div class="col-md-6">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'user_id',
                        'label' => 'Username',
                        'value' => function($model) {
                            return $model->user->username;
                        }
                    ],
                    'lastname',
                    'firstname',
                    'designation',
                    'middleinitial',
                    /*[
                        'rstl_id' => 'rstl_id',
                        'label' => 'RSTL',
                        'value' => function($model) {
                            return $model->rstl->name;
                        }
                    ],
                    [
                        'lab_id' => 'lab_id',
                        'label' => 'Laboratory',
                        'value' => function($model) {
                            return $model->lab->labname;
                        }
                    ],*/
                    'contact_numbers',
                ],
            ])
            ?>
            </div>
        </div>
    </div>
</div>
