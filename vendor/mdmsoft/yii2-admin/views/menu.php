<?php
use yii\helpers\Url;
/* 
 * Project Name: eulims * 
 * Copyright(C)2017 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 12 21, 17 , 12:53:52 PM * 
 * Module: menu * 
 */
$button= strtolower($button);
switch($button){
    case 'assignment':
        $Assignment='active';
        $User='';
        $route='';
        $role='';
        $permissions='';
        $menu='';
        $rule='';
        break;
    case 'user':
        $Assignment='';
        $User='active';
        $route='';
        $role='';
        $permissions='';
        $menu='';
        $rule='';
        break;
    case 'route':
        $Assignment='';
        $User='';
        $route='active';
        $role='';
        $permissions='';
        $menu='';
        $rule='';
        break;
    case 'roles':
        $Assignment='';
        $User='';
        $route='';
        $role='active';
        $permissions='';
        $menu='';
        $rule='';
        break;
    case 'permissions':
        $Assignment='';
        $User='';
        $route='';
        $role='';
        $permissions='active';
        $menu='';
        $rule='';
        break;
    case 'menu':
        $Assignment='';
        $User='';
        $route='';
        $role='';
        $permissions='';
        $menu='active';
        $rule='';
        break;
    case 'rule':
        $Assignment='';
        $User='';
        $route='';
        $role='';
        $permissions='';
        $menu='';
        $rule='active';
        break;
}
?>
<div class="row div-hr" style="padding-left: 1px">
    <div class="col-lg-12">
        <?php if(Yii::$app->user->can('access-user')){ ?>
        <a href="<?= Url::toRoute('/admin/user') ?>" class="btn btn-primary <?= $User ?>"></i>User</a>
        <?php } ?>
        <?php if(Yii::$app->user->can('access-assignment')){ ?>
        <a href="<?= Url::toRoute('/admin') ?>" class="btn btn-primary <?= $Assignment ?>"></i>Assignment</a>
        <?php } ?>
        <?php if(Yii::$app->user->can('access-route')){ ?>
        <a href="<?= Url::toRoute('/admin/route') ?>" class="btn btn-primary <?= $route ?>"></i>Route</a>
        <?php } ?>
        <?php if(Yii::$app->user->can('access-role')){ ?>
        <a href="<?= Url::toRoute('/admin/role') ?>" class="btn btn-primary <?= $role ?>"></i>Role</a>
        <?php } ?>
        <?php if(Yii::$app->user->can('access-permission')){ ?>
        <a href="<?= Url::toRoute('/admin/permission') ?>" class="btn btn-primary <?= $permissions ?>"></i>Permissions</a>
        <?php } ?>
        <?php if(Yii::$app->user->can('access-menu')){ ?>
        <a href="<?= Url::toRoute('/admin/menu') ?>" class="btn btn-primary <?= $menu ?>"></i>Menu</a>
        <?php } ?>
        <?php if(Yii::$app->user->can('access-ru;e')){ ?>
        <a href="<?= Url::toRoute('/admin/rule') ?>" class="btn btn-primary <?= $rule ?>"></i>Rule</a>
        <?php } ?>
    </div>
    <hr style="padding-bottom: 0px">
</div>