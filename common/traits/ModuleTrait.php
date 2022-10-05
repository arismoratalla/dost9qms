<?php


namespace common\traits;

use mdm\admin\Module;

/**
 * Trait ModuleTrait
 * @property-read Module $module
 * @package common\traits
 */
trait ModuleTrait
{
    /**
     * @return Module
     */
    public function getModule()
    {
        return \Yii::$app->getModule('user');
    }
}
