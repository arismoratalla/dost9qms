<?php
/* @var $this yii\web\View */
use yii\web\View;
use kartik\switchinput\SwitchInput;

$this->title = 'System Settings';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(
    "$(function() {
       $('#toggle-one').bootstrapToggle();
       $('#chkMaintenance').change(function(){
          alert('ok');
       });
     })",
    View::POS_READY,
    'my-button-handler'
);
if (Yii::$app->maintenanceMode->IsEnabled){
    $IsMaintenance=true;
    $PanelClass=' panel-danger';
    $setEnable="disable";
}else{
    $IsMaintenance=false;
    $setEnable="enable";
    $PanelClass=' panel-success';
}
?>
<div class="content">
    <?php if(Yii::$app->user->can('access-settings')){ ?>
    <div class="panel<?= $PanelClass ?>">
        <div class="panel-heading"><i class='fa fa-wrench'></i> System Maintenance</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <label for="chkMaintenance" class="control-label col-sm-3">Mode:</label>
                    <div class="col-sm-7">
                        <?php
                        echo SwitchInput::widget([
                            'name' => 'chkMaintenance',
                            'id' => 'chkMaintenance',
                            'value' => $IsMaintenance,
                            'pluginOptions' => [
                                'onText' => 'Maintenance',
                                'offText' => 'Live',
                                'onColor' => 'danger',
                                'offColor' => 'success',
                            ],
                            'pluginEvents' => [
                                "switchChange.bootstrapSwitch" => "
                    function() { 
                        $.ajax('/settings/" . $setEnable . "',{
                            data: {msg: $('#mMessage').val()},
                            success: function (data, status, xhr) {// success callback function
                            alert(data);
                            document.location=location.href;
                        }
                        });
                    }  
                ",
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="mMessage" class="control-label col-sm-3">Message:</label>
                    <div class="col-sm-7">
                        <textarea id="mMessage" name="mMessage" class="form-control"><?= Yii::$app->maintenanceMode->message ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>