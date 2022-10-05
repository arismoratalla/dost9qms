<?php
/**
 * @link https://github.com/brussens/yii2-maintenance-mode
 * @copyright Copyright (c) 2017 Brusensky Dmitry
 * @license http://opensource.org/licenses/MIT MIT
 */

use yii\helpers\Html;

/**
 * Default view of maintenance mode component for Yii framework 2.x.x version.
 *
 * @since 0.2.0
 * @author Brusensky Dmity <brussens@nativeweb.ru>
 */

/** @var $title string */
/** @var $message string */
//$Session=Yii::$app->session;
//$mMessage=$Session->get('mMessage');
?>
<div class="col-md-8">
<img src="/images/maintenance.jpg" alt="" width="300" height="180"/>
<h1><?= Html::encode($title) ?></h1>
<div>
    <p><?= Html::encode($message) ?></p>
</div>
</div>