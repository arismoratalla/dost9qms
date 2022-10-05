<?php
use yii\helpers\ArrayHelper;

//register Module from ini files
$ModulesSetting=parse_ini_file(__DIR__.'/modules.ini',true);
//Merger Arrays
return ArrayHelper::merge($ModulesSetting, []);