<?php
/* @var $this yii\web\View */
use yii\helpers\FileHelper;
use yii\web\View;
use common\models\system\Package;
use yii\bootstrap\Modal;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use kartik\form\ActiveForm;

$this->title = 'Package Manager';
$this->params['breadcrumbs'][] = $this->title;
$PathFiles= Yii::$app->basePath.'\web\uploads\packages';
$js="var bUrl='".$GLOBALS['base_uri']."';\n";
$js.=<<<SCRIPT
    var PackageUrl;
    var PackageName;
    var IniMessage=" Install ";
    $("#btnInstallPackage").click(function(e){
        //alert("Install Package: "+PackageUrl+" PackageName: "+PackageName);
        ExecutePrompt(PackageUrl, PackageName);
    }); 
    $("#btnReinstallPackage").click(function(e){
        ExecutePrompt(PackageUrl, PackageName);
    }); 
    $("#btnUninstallPackage").click(function(e){
        RemoveModule();
    }); 
    $("#btnCreateModule").click(function(e){
        CreateModule();
    }); 
    $("#btnExportPackage").click(function(e){
        ExportPackage();
    });
    $("#PackageList").click(function(e){
        PackageUrl=this.value;
        PackageName=$("#PackageList option:selected").text();
        IniMessage=" Install ";
        $("#btnUninstallPackage").prop("disabled",true);
        $("#btnReinstallPackage").prop("disabled",true);
        $("#btnExportPackage").prop("disabled",true);
        $("#btnImportPackage").prop("disabled",!PackageName);
        $("#btnInstallPackage").prop("disabled",!PackageName);
    });
    $("#InstalledPackageList").click(function(e){
        PackageUrl=this.value;
        PackageName=$("#InstalledPackageList option:selected").text();
        IniMessage=" Reinstall ";
        $("#btnUninstallPackage").prop("disabled",!PackageName);
        $("#btnReinstallPackage").prop("disabled",!PackageName);
        $("#btnExportPackage").prop("disabled",!PackageName);
        $("#btnImportPackage").prop("disabled",true);
        $("#btnInstallPackage").prop("disabled",true);
    });
    function ExportPackage(){
        var DownloadURL='/uploads/packages/'+PackageName.toLowerCase()+'.zip';
        bootbox.confirm({
        message: "Are you sure you want to export '"+PackageName+"' Module?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result){
                $.ajax({
                    url: bUrl+'/package/export',
                    type: 'post',
                    data: {pack: PackageName},
                    success: function( data, textStatus, jQxhr ){
                        bootbox.alert(data, function(){ 
                            window.open(DownloadURL, '_blank');
                        });
                        
                    },
                    error: function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                    }
                });
            }
        }
        }); 
    }
    function RemoveModule(){
        bootbox.confirm({
        message: "Are you sure you want to uninstall '"+PackageName+"' Module?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result){
                $.ajax({
                    url: bUrl+'package/removemodule',
                    type: 'post',
                    data: {url: PackageUrl},
                    success: function( data, textStatus, jQxhr ){
                        bootbox.alert(data, function(){ document.location=location.href; });
                    },
                    error: function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                    }
                });
            }
        }
        }); 
    }
    function ExecutePrompt(PackageUrl, PackageName){
        bootbox.confirm({
        message: "Do you want to "+IniMessage+" '"+PackageName+"' Module?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result){
                $.ajax({
                    url: bUrl+'/package/extract',
                    type: 'post',
                    data: {url: PackageUrl, pack: PackageName},
                    success: function( data, textStatus, jQxhr ){
                        bootbox.alert(data, function(){ document.location=location.href; });
                    },
                    error: function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                    }
                });
            }
        }
        });
    }
    function CreateModule(){
        bootbox.prompt("Enter the module name: ", function(result){ 
            var url=bUrl+'/package/createmodule';
            if(result){
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {modname: result},
                    success: function( data, textStatus, jQxhr ){
                        bootbox.alert(data, function(){ document.location=location.href; });
                    },
                    error: function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                        alert(errorThrown);
                    }
                });
            }
        });
    }
SCRIPT;
$this->registerJs($js, View::POS_READY,'script-handler');
//Get installed Package
$Packages= Package::find()->all();

?>
 <div class="panel panel-default col-xs-12">
     <div class="panel-heading"><i class="fa fa-braille"></i> Package Manager <small>version 1.0</small></div>
        <div class="panel-body"> 
            <hr style="margin-top: 0px;margin-bottom: 0px">
            <div class="col-sm-4" style="height: 100%;padding-left: 0px">
                <div class="row col-xs-12" style="float: left"><strong>Available Packages</strong></div>
                <div class="row" style="clear: both;min-height: 380px">
                    <select id="PackageList" class="form-control fill" style="height: 100%" size="21">
                    <?php
                        $files = FileHelper::findFiles($PathFiles, ['recursive' => false, 'filter' => function ($path) {
                            return !in_array(substr(basename($path), 0, 1), ['*.zip']);
                        }]);
                        foreach ($files as $file) {
                            $fileinfo = pathinfo($file);
                            $fileBaseName = $fileinfo['filename'];
                            $Found=false;
                            foreach($Packages as $Package){
                                 if($Package->PackageName==$fileBaseName){
                                     $Found=true;
                                     break;
                                 }
                            }
                            if(!$Found){
                                echo "<option value='".$file."'>".ucwords($fileBaseName)."</option>";
                            }
                        }
                            ?>
                    </select>
                </div>
                <?php 
                    Modal::begin([
                        'header'=>'Import Package Module',
                        'toggleButton' => [
                            'label'=>'<span class="fa fa-upload"></span> Import Package', 'class'=>'btn btn-primary btn-float-left'
                        ],
                    ]);
                    $form1 = ActiveForm::begin([
                        'options'=>['enctype'=>'multipart/form-data'], // important
                        'action'=>'/package/upload'
                    ]);
                    //echo $form1->field($model, 'upload')->fileInput();
                    echo FileInput::widget([
                        'model' => $model,
                        'attribute' => 'upload',
                        'language' => 'en',
                        'options' => ['accept' => '.zip'],
                        'pluginOptions' => [
                           // 'uploadUrl' => Url::to(['/package/upload'])
                            'allowedFileExtensions'=> ['zip'],
                        ]
                    ]);
                    ActiveForm::end();
                    Modal::end();
                ?>
                <button id="btnInstallPackage" disabled class="btn btn-primary btn-float-left"><span class="fa fa-plus-circle"></span> Install</button>
            </div>
            <div class="col-sm-8" style="height: 100%;padding-left: 0px">
                <div class="row col-xs-12" style="float: left"><strong>Installed Packages</strong></div>
                <div class="row" style="clear: both;min-height: 380px">
                    <select id="InstalledPackageList" class="form-control fill" style="height: 100%" size="21">
                    <?php
                        foreach($Packages as $Package){
                           echo "<option value='".$PathFiles."\\".$Package->PackageName.".zip'>".ucwords($Package->PackageName)."</option>"; 
                        }
                    ?>
                    </select>
                </div>
                <button id="btnUninstallPackage" disabled class="btn btn-primary btn-float-left"><span class="fa fa-minus-circle"></span> Uninstall</button>
                <button id="btnReinstallPackage" disabled class="btn btn-primary btn-float-left"><span class="fa fa-arrow-circle-o-up"></span> Reinstall</button>
                <button id="btnExportPackage" disabled class="btn btn-primary btn-float-left"><span class="fa fa-download"></span> Export</button>
                <button id="btnCreateModule" class="btn btn-primary btn-float-left"><span class="fa fa-building"></span> Create Module</button>
            </div>
        </div>
 </div>