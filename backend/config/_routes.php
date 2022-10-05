<?php


return [
    //'admin/profile/view/<id:>' => 'admin/role/view', //admin/role/view?id=admin
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
];
