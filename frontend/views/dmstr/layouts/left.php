<?php
use yii\helpers\Html;

use common\models\system\User;

if(Yii::$app->user->isGuest){
    $CurrentUserName="Visitor";
    $CurrentUserAvatar=Yii::$app->params['uploadUrl'] . 'no-image.png';
    $CurrentUserDesignation='Guest';
    $UsernameDesignation=$CurrentUserName;
}else{
    $CurrentUser= User::findOne(['user_id'=> Yii::$app->user->identity->user_id]);
    $CurrentUserName=$CurrentUser->profile ? $CurrentUser->profile->fullname : $CurrentUser->username;
    // $CurrentUserAvatar=$CurrentUser->profile ? Yii::$app->params['uploadUrl'].$CurrentUser->profile->getImageUrl() : Yii::$app->params['uploadUrl'] . 'no-image.png';
    $CurrentUserAvatar=$CurrentUser->profile ? "/images/user/photo/" . $CurrentUser->profile->avatar : "/images/user/photo/" . 'no-image.png';
    $CurrentUserDesignation=$CurrentUser->profile ? $CurrentUser->profile->designation : '';
    if($CurrentUserDesignation==''){
       $UsernameDesignation=$CurrentUserName;
    }else{
       $UsernameDesignation=$CurrentUserName.'-'.$CurrentUserDesignation;
    }
}
?>

<aside class="main-sidebar">
    <section class="sidebar">
    
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $CurrentUserAvatar ?>" class="img-circle" alt="User Image"/>
                <!-- <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/> -->
            </div>
            <div class="pull-left info">
                <p><?= $CurrentUserName ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    // ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    // ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    // ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    [
                        'label' => 'Risk Management', 
                        'icon' => 'folder',
                        'visible'=> ( Yii::$app->user->can('riskman-basic-role') || (Yii::$app->user->identity->username == 'Admin') ),
                        'items' => [
                            [
                                'label' => 'Dashboard', 
                                'icon' => 'dashboard text-aqua', 
                                'url' => ['/riskman/default/dashboard','year'=>2023],
                            ],
                            [
                                'label' => 'Goals and Awards', 
                                'icon' => 'dashboard text-aqua', 
                                'url' => ['/riskman/default/awards'],
                            ],
                            [
                                'label' => 'Monitoring', 
                                'icon' => 'file text-aqua', 
                                'url' => ['/riskman/registry/monitoring','registry_type'=>'Risk', 'year'=>2023],
                            ],
                            [
                                'label' => 'Registry (old)', 
                                'icon' => 'file text-aqua', 
                                'url' => ['/riskman/registryassessment/index','registry_type'=>'Risk', 'year'=>2023],
                                'visible' => (Yii::$app->user->identity->username == 'Admin'),
                            ],
                            [
                                'label' => 'Registry', 
                                'icon' => 'file text-aqua', 
                                'url' => ['/riskman/registry/index','registry_type'=>'Risk', 'year'=>2023],
                            ],
                            [
                                'label' => 'Registry (draft)', 
                                'icon' => 'file text-aqua', 
                                'url' => ['/riskman/registry/draft'],
                            ],
                            
                            [
                                'label' => 'Library', 
                                'icon' => 'table text-aqua', 
                                'url' => ['/riskman/risk/library'],
                                'items' => [
                                    [
                                        'label' => 'Criteria & Appetite', 
                                        'icon' => 'check text-aqua', 
                                        'url' => ['/riskman/document/index'],
                                    ],
                                    [
                                        'label' => 'Categories', 
                                        'icon' => 'bars text-aqua', 
                                        'url' => ['/riskman/document/index'],
                                    ],
                                    [
                                        'label' => 'Badges', 
                                        'icon' => 'bookmark text-aqua', 
                                        'url' => ['/riskman/badge/index', 'module_id'=>'riskman'],
                                    ],
                                    [
                                        'label' => 'Settings', 
                                        'icon' => 'bookmark text-aqua', 
                                        'url' => ['/riskman/default/settings', 'module_id'=>'riskman'],
                                    ],
                                ]
                            ],
                        ]
                    ],
                    [
                        'label' => 'ISO 9001 QMS', 
                        'icon' => 'book',
                        'visible'=> ( Yii::$app->user->can('9001-qms-role') || (Yii::$app->user->identity->username == 'Admin') ),
                        'items' => [
                            [
                                'label' => 'Directory', 
                                'icon' => 'dashboard text-aqua', 
                                'url' => ['/docman/default/directory'],
                            ],
                            
                        ]
                    ],
                    [
                        'label' => 'ISO 9001', 
                        'icon' => 'book',
                        'visible'=> ( Yii::$app->user->can('9001-basic-role') || (Yii::$app->user->identity->username == 'Admin') ),
                        'items' => [
                            // [
                            //     'label' => 'Dashboard', 
                            //     'icon' => 'dashboard text-aqua', 
                            //     'url' => ['/docman/document/index', 'qms_type_id'=>1],
                            // ],
                            [
                                'label' => 'Documents', 
                                'icon' => 'folder text-aqua', 
                                'url' => ['/docman/document/index', 'qms_type_id'=>1],
                                'items' => [
                                    [
                                        'label' => 'Quality Manual', 
                                        'icon' => 'check text-aqua', 
                                        'url' => ['/docman/document/index', 'qms_type_id'=>1, 'category_id'=>1],
                                    ],
                                    [
                                        'label' => 'Procedure Manual', 
                                        'icon' => 'bars text-aqua', 
                                        'url' => ['/docman/document/index', 'qms_type_id'=>1, 'category_id'=>2],
                                    ],
                                    [
                                        'label' => 'Work Instruction', 
                                        'icon' => 'table text-aqua', 
                                        'url' => ['/docman/document/index', 'qms_type_id'=>1, 'category_id'=>3],
                                    ],
                                    [
                                        'label' => 'Forms Manual', 
                                        'icon' => 'folder text-aqua', 
                                        'url' => ['/docman/document/formsindex', 'qms_type_id'=>1], 
                                    ],
                                ]
                            ],
                        ]
                    ],
                    [
                        'label' => 'ISO 17025', 
                        'icon' => 'book', 
                        'visible'=> ( Yii::$app->user->can('17025-auditor-access') || Yii::$app->user->can('17025-basic-role') || (Yii::$app->user->identity->username == 'Admin') ),
                        'items' => [
                            [
                                'label' => 'Dashboard', 
                                'icon' => 'dashboard text-aqua', 
                                'url' => ['/docman/default/dashboard', 'qms_type_id'=>2],
                            ],
                            [
                                'label' => 'Documents', 
                                'icon' => 'folder-open text-aqua', 
                                'url' => ['/docman/document/index', 'qms_type_id'=>2],
                                'visible'=> ( Yii::$app->user->can('17025-auditor-access') || Yii::$app->user->can('17025-basic-role') || (Yii::$app->user->identity->username == 'Admin') ),
                                'items' => [
                                    [
                                        'label' => 'Quality Manual', 
                                        'icon' => 'check text-aqua', 
                                        'url' => ['/docman/document/index', 'qms_type_id'=>2, 'category_id'=>1],
                                    ],
                                    [
                                        'label' => 'Operational Procedure', 
                                        'icon' => 'bars text-aqua', 
                                        'url' => ['/docman/document/index', 'qms_type_id'=>2, 'category_id'=>2],
                                    ],
                                    [
                                        'label' => 'Work Instruction', 
                                        'icon' => 'table text-aqua', 
                                        'url' => ['/docman/document/index', 'qms_type_id'=>2, 'category_id'=>3],
                                    ],
                                    [
                                        'label' => 'Methods', 
                                        'icon' => 'gear text-aqua', 
                                        'url' => ['/docman/document/index', 'qms_type_id'=>2, 'category_id'=>5, 'functional_unit_id'=>5],
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Techinical Records', 
                                'icon' => 'folder-open text-aqua', 
                                'url' => ['/docman/document/technicalrecordsindex', 'qms_type_id'=>2],
                                'visible'=> ( Yii::$app->user->can('17025-technical-records') || (Yii::$app->user->identity->username == 'Admin') ),
                            ],
                            [
                                'label' => 'Records', 
                                'icon' => 'folder-open text-aqua', 
                                'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2],
                                'visible'=> ( Yii::$app->user->can('17025-basic-role') || (Yii::$app->user->identity->username == 'Admin') ),
                                'items' => [
                                    [
                                        'label' => 'PT Reports', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>4],
                                    ],
                                    [
                                        'label' => 'Impartiality', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>10],
                                    ],
                                    [
                                        'label' => 'Non-Disclosure Agreement', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>17],
                                    ],
                                    [
                                        'label' => 'Authorization', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>6],
                                    ],
                                    [
                                        'label' => 'Duties and Responsibilities', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>7],
                                    ],
                                    [
                                        'label' => 'Memorandum', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>12],
                                    ],
                                    [
                                        'label' => 'Quotation', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>9],
                                    ],
                                    [
                                        'label' => 'Nonconformities', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>8],
                                    ],
                                    [
                                        'label' => 'Laboratory Review', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>15],
                                    ],
                                    [
                                        'label' => 'Masterlist of Documents', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>16],
                                    ],
                                    [
                                        'label' => 'Document Control Form', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>13],
                                    ],
                                    [
                                        'label' => 'Document Control Index', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>14],
                                    ],
                                    [
                                        'label' => 'Letters (Incoming)', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>18],
                                    ],
                                    [
                                        'label' => 'Letters (Outgoing)', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>19],
                                    ],
                                    [
                                        'label' => 'Training Records', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>20],
                                    ],
                                    [
                                        'label' => 'Competency Records', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>21],
                                    ],
                                    [
                                        'label' => 'Personnel Resume', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>22],
                                    ],
                                    [
                                        'label' => 'Other Records', 
                                        'icon' => 'file text-aqua', 
                                        'url' => ['/docman/document/labrecordsindex', 'qms_type_id'=>2, 'category_id'=>23],
                                    ],
                                ]
                            ],
                            [
                                'label' => 'References', 
                                'icon' => 'folder-open text-aqua', 
                                'url' => ['/docman/document/referenceindex', 'qms_type_id'=>2, 'category_id'=>24],
                                'visible'=> ( Yii::$app->user->can('17025-basic-role') || (Yii::$app->user->identity->username == 'Admin') ),
                            ],
                            [
                                'label' => 'Training Materials', 
                                'icon' => 'folder-open text-aqua', 
                                'url' => ['/docman/document/referenceindex', 'qms_type_id'=>2, 'category_id'=>25],
                                'visible'=> ( Yii::$app->user->can('17025-basic-role') || (Yii::$app->user->identity->username == 'Admin') ),
                            ],
                        ]
                    ],
                    [
                        'label' => 'System tools',
                        'icon' => 'cogs',
                        'url' => '/#',
                        'visible'=> Yii::$app->user->can('access-system-tools'),
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],'visible'=> Yii::$app->user->can('access-gii')],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],'visible'=> Yii::$app->user->can('access-debug')],
                            [
                                'label' => 'RBAC',
                                'icon' => 'fa fa-user-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Users', 'icon' => 'fa fa-user-o', 'url' => ['/admin/user'],'visible'=> Yii::$app->user->can('access-user')],
                                    ['label' => 'Groups', 'icon' => 'dashboard', 'url' => ['/admin/group'],'visible'=> Yii::$app->user->can('access-user')],
                                    ['label' => 'Assignment', 'icon' => 'dashboard', 'url' => ['/admin'],'visible'=> Yii::$app->user->can('access-assignment')],
                                    ['label' => 'Route', 'icon' => 'line-chart', 'url' => ['/admin/route'],'visible'=> Yii::$app->user->can('access-route')],
                                    ['label' => 'Roles', 'icon' => 'glide-g', 'url' => ['/admin/role'],'visible'=> Yii::$app->user->can('access-role')],
                                    ['label' => 'Permissions', 'icon' => 'resistance', 'url' => ['/admin/permission'],'visible'=> Yii::$app->user->can('access-permission')],
                                    ['label' => 'Menus', 'icon' => 'scribd', 'url' => ['/admin/menu'],'visible'=> Yii::$app->user->can('access-menu')],
                                    ['label' => 'Rules', 'icon' => 'reorder', 'url' => ['/admin/rule'],'visible'=> Yii::$app->user->can('access-rule')],
                                ],
                                'visible'=> Yii::$app->user->can('access-rbac')
                            ],
                            ['label' => 'Functional units', 'icon' => 'fa file-users', 'url' => ['/docman/functionalunit/index'],'visible'=> Yii::$app->user->can('access-gii')],
                        ],
                    ],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Account Setting',
                        'icon' => 'user',
                        'items' => [
                            ['label' => 'Profile', 'icon' => 'user', 'url' => ['/profile'],'visible'=> Yii::$app->user->can('access-settings')],
                            ['label' => 'Change Password', 'icon' => 'key', 'url' => ['/admin/user/change-password'],'visible'=> Yii::$app->user->can('access-settings')],
                            ['label' => 'Login', 'icon' => 'user', 'url' => ['/site/login'],'visible'=>  Yii::$app->user->isGuest],
                            ['label' => 'Sign Out', 'icon' => 'user-times'  , 'url' => Yii::$app->urlManager->createUrl(['/site/logout']), 'visible' => !Yii::$app->user->isGuest, 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>'],
                        ]
                    ],
                    /*[
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                ],
            ]
        ) ?>

    </section>

</aside>


