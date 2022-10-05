<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use common\models\system\Rstl;
use common\models\system\User;
//use common\models\lab\Lab;
use yii\grid\ActionColumn;

//use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;

//$RstlList= ArrayHelper::map(Rstl::find()->all(),'rstl_id','name');
//$LabList= ArrayHelper::map(lab::find()->all(),'lab_id','labname'); //Yii::$app->user->identity->user_id
if(Yii::$app->user->can('access-his-profile')){
    $UserList= ArrayHelper::map(User::findAll(['user_id'=>Yii::$app->user->identity->user_id]),'user_id','username');
}else{
    $UserList= ArrayHelper::map(User::find()->all(),'user_id','username');
}
if(!Yii::$app->user->can('can-delete-profile')){
   $Buttontemplate='{view}{update}';
}else{
   $Buttontemplate='{view}{update}{delete}'; 
}
$gridColumn = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'user_id',
        'label' => 'User',
        'value' => function($model) {
            return $model->user->username;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(User::find()->asArray()->all(), 'user_id', 'username'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'User', 'userz_id' => 'grid-products-search-category_type_id']
    ],
    'lastname',
    'firstname',
    'middleinitial',
    /*[
        'attribute' => 'rstl_id',
        'label' => 'RSTL',
        'value' => function($model) {
            return $model->rstl->name;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Rstl::find()->asArray()->all(), 'rstl_id', 'name'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'RSTL', 'id' => 'grid-products-search-category_type_id']
    ],
    [
        'attribute' => 'lab_id',
        'label' => 'Laboratory',
        'value' => function($model) {
            return $model->lab->labname;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Lab::find()->asArray()->all(), 'lab_id', 'labname'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Laboratory', 'lab_id' => 'grid-products-search-category_type_id']
    ],*/
    // 'lab_id',
    [
        //'class' => 'yii\grid\ActionColumn'
        'class' => ActionColumn::className(),
        'template' => $Buttontemplate,
    ],
];
?>
<div class="profile-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <!--?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?-->
    </p>
    <div class="table-responsive">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumn,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-products']],
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
            ],
            /*'toolbar' => [
                '{export}',
                ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumn,
                    'target' => ExportMenu::TARGET_BLANK,
                    'fontAwesome' => true,
                    'dropdownOptions' => [
                        'label' => 'Full',
                        'class' => 'btn btn-default',
                        'itemsBefore' => [
                            '<li class="dropdown-header">Export All Data</li>',
                        ],
                    ],
                ]),
            ],
            */
        ]);
        ?>
    </div>
</div>
