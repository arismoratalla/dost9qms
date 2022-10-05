<?php
use yii\helpers\Url;

$button= strtolower($button);
switch($button){
    case 'assignment':
        $Assignment='active';
        $User='';
        $Group='';
        $route='';
        $role='';
        $permissions='';
        $menu='';
        $rule='';
        break;
    case 'Group':
        $Assignment='';
        $User='';
        $Group='active';
        $route='';
        $role='';
        $permissions='';
        $menu='';
        $rule='';
        break;
    case 'user':
        $Assignment='';
        $User='active';
        $Group='';
        $route='';
        $role='';
        $permissions='';
        $menu='';
        $rule='';
        break;
    case 'route':
        $Assignment='';
        $User='';
        $Group='';
        $route='active';
        $role='';
        $permissions='';
        $menu='';
        $rule='';
        break;
    case 'roles':
        $Assignment='';
        $User='';
        $Group='';
        $route='';
        $role='active';
        $permissions='';
        $menu='';
        $rule='';
        break;
    case 'permissions':
        $Assignment='';
        $User='';
        $Group='';
        $route='';
        $role='';
        $permissions='active';
        $menu='';
        $rule='';
        break;
    case 'menu':
        $Assignment='';
        $User='';
        $Group='';
        $route='';
        $role='';
        $permissions='';
        $menu='active';
        $rule='';
        break;
    case 'rule':
        $Assignment='';
        $User='';
        $Group='';
        $route='';
        $role='';
        $permissions='';
        $menu='';
        $rule='active';
        break;
}
?>
<div class="row div-hr" id="rbac-menu" style="padding-left: 1px">
    <div class="col-lg-12">
        <?php if(Yii::$app->user->can('access-user')){ ?>
        <a href="<?= Url::toRoute('/admin/user') ?>" class="btn btn-primary <?= $User ?>"></i>User</a>
        <?php } ?>
        <?php if(Yii::$app->user->can('access-user')){ ?>
        <a href="<?= Url::toRoute('/admin/group') ?>" class="btn btn-primary <?= $User ?>"></i>Group</a>
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