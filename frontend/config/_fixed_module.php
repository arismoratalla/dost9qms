<?php
return [
    'admin' => [
        'class' => 'common\modules\admin\Module',
        //'class' => 'common\mdm\admin\Module',
        //'class' => 'mdm\admin\Module',
    ], 
    'imagemanager' => [
        'class' => 'noam148\imagemanager\Module',
        //set accces rules ()
        'canUploadImage' => true,
        'canRemoveImage' => function() {
            return true;
        },
        'deleteOriginalAfterEdit' => false, // false: keep original image after edit. true: delete original image after edit
        // Set if blameable behavior is used, if it is, callable function can also be used
        'setBlameableBehavior' => false,
        //add css files (to use in media manage selector iframe)
        'cssFiles' => [
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
        ],
    ],
    'message' => [
           'class' => 'common\modules\message\Module',
           'userModelClass' => '\common\models\system\User', // your User model. Needs to be ActiveRecord.
    ],
];
