<?php 
/***
 * @var $model app\model\User
 */
$url = $GLOBALS['base_uri'];

?>
<style>
    img{ width: 10%; }
    a{ text-decoration:none; }
    a.button{ padding: 10px 20px; background: #1abc9c }
</style>

    <div style="padding:50px; width:60%; margin:0 auto; background:#fdfdfd; text-align:center;">
        <img style="width:20%" src="http://web.onelab.ph/images/onelab9.png">
        <h1 style="color:#000000; font-size:20px; padding-bottom:5px; border-bottom:1px solid #dddddd; text-transform:uppercase;" >
        Verify your email address
        </h1>

        <p style="color:#000000; font-size:14px; margin-bottom:50px;"> Please verify your email address and activate your EULIMS account by clicking on the button below:</p>

        <a href="<?= $url ?>site/verify?id=<?=md5($model->user_id)?>&auth_key=<?=$model->auth_key ?>&email=<?=$model->email?>" style=" text-decoration:none; display:inline-block; padding:10px 20px; background:#1abc9c; color:#ffffff; text-transform:uppercase;" > 
        Verify Now
        </a>
    </div>
