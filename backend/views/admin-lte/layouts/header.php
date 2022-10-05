<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\system\User;
/* @var $this \yii\web\View */
/* @var $content string */
$photoUrl="//".$_SERVER['SERVER_NAME'].Yii::getAlias('@web').Yii::$app->params['uploadUrl'];
/*$Request_URI=$_SERVER['REQUEST_URI'];
if($Request_URI=='/'){//alias ex: http://admin.eulims.local
    $Backend_URI='//'.$_SERVER['SERVER_NAME'];
    $Backend_URI=$Backend_URI."/uploads/user/photo/";
}else{//http://localhost/eulims/backend/web
    $Backend_URI='//localhost/eulims/backend/web/uploads/user/photo/';
}
Yii::$app->params['uploadUrl']=$Backend_URI;
 * 
 */
Yii::$app->params['uploadUrl']=$GLOBALS['upload_url'];
if(Yii::$app->user->isGuest){
    $CurrentUserName="Visitor";
    //$CurrentUserAvatar=Yii::$app->params['uploadUrl'] . 'no-image.png';
    $CurrentUserAvatar= $photoUrl.'/no-image.png';
    $CurrentUserDesignation='Guest';
    $UsernameDesignation=$CurrentUserName;
}else{
    $CurrentUser= User::findOne(['user_id'=> Yii::$app->user->identity->user_id]);
    $CurrentUserName=$CurrentUser->profile ? $CurrentUser->profile->fullname : $CurrentUser->username;
    $CurrentUserAvatar=$CurrentUser->profile ? Yii::$app->params['uploadUrl'].$CurrentUser->profile->getImageUrl() : Yii::$app->params['uploadUrl'] . 'no-image.png';
    $CurrentUserDesignation=$CurrentUser->profile ? $CurrentUser->profile->designation : '';
    if($CurrentUserDesignation==''){
       $UsernameDesignation=$CurrentUserName;
    }else{
       $UsernameDesignation=$CurrentUserName.'-'.$CurrentUserDesignation;
    }
}
?>

<header class="main-header">
    <?= Html::a(Html::img(Yii::$app->request->baseUrl."/images/logo.png",['title'=>'Finance and Administrative Information Management System','alt'=>'Enhanced FAIMS','height'=>'30px']), Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $CurrentUserAvatar ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= $CurrentUserName ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $CurrentUserAvatar ?>" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?= $UsernameDesignation ?> 
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <hr style="margin: 0 0 0 0;padding: 0 0 0 0">
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php if(Yii::$app->user->can('access-profile') || Yii::$app->user->can('access-his-profile')){ ?>
                                <a href="<?= Url::toRoute('/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                <?php }else{ ?>
                                <a href="#" class="btn btn-default btn-flat disabled">Profile</a>
                                <?php } ?>
                            </div>
                            <div class="pull-right">
                                <?php if(Yii::$app->user->isGuest){ ?>
                                <?= Html::a(
                                    'Login',
                                    ['/site/login'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?> 
                                <?php }else{ ?>
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?> 
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
