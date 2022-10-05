<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
//use common\models\system\Rstl;
use common\models\system\User;
use common\models\lab\Lab;
use yii\grid\ActionColumn;
//use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;

//$RstlList= ArrayHelper::map(Rstl::find()->all(),'rstl_id','name');
//$LabList= ArrayHelper::map(lab::find()->all(),'lab_id','labname');
$UserList= ArrayHelper::map(User::find()->all(),'user_id','username');
if(!Yii::$app->user->can('can-delete-profile')){
   $Buttontemplate='{view}{update}';
}else{
   $Buttontemplate='{view}{update}{delete}'; 
}
?>
<div class="profile-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Profiles</div>
        <div class="panel-body">   
            <p>
                <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <div class="table-responsive">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'user_id',
                        'label'=>'Username',
                        'filter'=>$UserList,
                        'value'=>function($model){
                            return $model->user->username;
                        }
                    ],
                    'lastname',
                    'firstname',
                    'middleinitial',      
                    /*[
                        'attribute'=>'rstl_id',
                        'label'=>'RSTL',
                        'filter'=>$RstlList,
                        'value'=>function($model){
                            return $model->rstl->name;
                        }
                    ],
                    [
                        'attribute'=>'lab_id',
                        'label'=>'Lab',
                        'filter'=>$LabList,
                        'value'=>function($model){
                            return $model->lab->labname;
                        }
                    ],*/
                    // 'lab_id',
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
</div>
