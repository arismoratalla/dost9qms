<?php
/**
 * Created by PhpStorm.
 * User: Larry
 * Date: 4/27/2018
 * Time: 9:12 AM
 */

namespace common\components;

use yii\base\Widget;
use kartik\select2\Select2;
use yii\helpers\Html;

class MyPrint extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
    }

    public function run()
    {

    $forms="";
    $myOrientation[] = ["Portrait","Landscape"] ;
    $forms = '<div class="col-lg-6">';
    $forms = $forms.'<label>Orientation</label>';
    $forms = $forms.'<select class="form-control">';
    $forms = $forms.'<option selected value="Portrait">Portrait</option>';
    $forms = $forms.'<option value="Landscape">Landscape</option>';
    $forms = $forms.'</select>';
    $forms = $forms.'</div>';
    return $forms;
    }


}