<?php

namespace common\components;
use Yii;
use ArrayAccess;
use IteratorAggregate;
use ArrayIterator;
use common\models\system\Package;
use common\models\auth\AuthItem;
use common\models\auth\AuthItemChild;
/**
 * This class process Ini file
 *
 * @author OneLab
 */
class IniObject implements ArrayAccess, IteratorAggregate {

    public $lang=[];
    public $Success=false;
    public $IniUrl=__DIR__.'\..\..\frontend\config\modules.ini';

    public function __construct($processAction = true) {
        if(file_exists($this->IniUrl)){
            $this->lang = parse_ini_file($this->IniUrl, $processAction);
            return true;
        }else{
             throw new \yii\web\HttpException(404, 'Configuration file "'.basename($ini).'" does not exist.');
        }
    }

    function __invoke($offset) {
        return $this->offsetGet($offset);
    }

    public function getIterator() {
        return new ArrayIterator($this->lang);
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->lang[] = $value;
        } else {
            $this->lang[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->lang[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->lang[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->lang[$offset]) ? $this->lang[$offset] : null;
    }

    public function write_php_ini($array, $file) {
        $res = array();
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $res[] = "[$key]";
                foreach ($val as $skey => $sval)
                    $res[] = "$skey = " . (is_numeric($sval) ? $sval : '"' . $sval . '"');
            } else
                $res[] = "$key = " . (is_numeric($val) ? $val : '"' . $val . '"');
        }
        return $this->safefilerewrite($file, implode("\r\n", $res));
    }

    public function safefilerewrite($fileName, $dataToSave) {
        $canWrite=false;
        if ($fp = fopen($fileName, 'w')) {
            $startTime = microtime(TRUE);
            do {
                $canWrite = flock($fp, LOCK_EX);
                // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
                if (!$canWrite)
                    usleep(round(rand(0, 100) * 1000));
            } while ((!$canWrite)and ( (microtime(TRUE) - $startTime) < 5));
            //Header
            $Header=";This is a System generated configuration file.".PHP_EOL;
            $Header.=";Created: ". gmdate('m/d/Y h:i A',filectime($fileName)).PHP_EOL;
            $Header.=";Last Updated: ".date('m/d/Y h:i A').PHP_EOL;
            //file was locked so now we can store information
            if ($canWrite) {
                fwrite($fp, $Header.$dataToSave);
                flock($fp, LOCK_UN);
            }
            fclose($fp);
        }
        return $canWrite;
    }
    public function IniKeyExist($Key){
        $ret=array_key_exists($Key,$this->lang);
        return $ret;
    }
    public function RemoveModule($ModuleName){
        $ModulePath=\Yii::getAlias('@frontend')."/modules/$ModuleName";
        //$this->lang = parse_ini_file($this->IniUrl, true);
        $KeyToDelete=$ModuleName;
        if ($this->IniKeyExist($KeyToDelete)) {
            unset($this->lang[$KeyToDelete]);
        }
        $Package= Package::find()->where("PackageName='$ModuleName'")->one();
        if($Package){
            $Package->delete();
        }
        //Remove Directory
        $this->deleteDirectory($ModulePath);
        //Save the Ini File
        $this->write_php_ini($this->lang, $this->IniUrl);
        return "Module '$ModuleName' Successfully uninstalled.";
    }
    public function deleteDirectory($dir) { 
        if (!file_exists($dir)) { return true; }
        if (!is_dir($dir) || is_link($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) { 
            if ($item == '.' || $item == '..') { continue; }
            if (!$this->deleteDirectory($dir . "/" . $item, false)) { 
                chmod($dir . "/" . $item, 0777); 
                if (!$this->deleteDirectory($dir . "/" . $item, false)) return false; 
            }; 
        } 
        return rmdir($dir); 
    }

    /**
     * Save Ini to file or Update content
     * @param string $IniFile
     * @param array $LoadedArray
     * @param array $ItemArray
     */
    public function SaveIniFile($IniFile,array $LoadedArray, array $ItemArray){
        $Key = key($ItemArray);

        if ($this->IniKeyExist($Key)) {
            foreach ($LoadedArray as $k => $value) {
                if ($k == $Key && array_key_exists($Key, $ItemArray)) {
                    //Found
                    $LoadedArray[$k] = $ItemArray[$k];
                }
            }
        } else {//Merge items
            $LoadedArray = array_merge($LoadedArray, $ItemArray);
        }
        //var_dump($LoadedArray);
        return $this->write_php_ini($LoadedArray, $IniFile);
    }
    /**
     * This Procedure will install Module Programmatically
     * @param type $ModuleName
     */
    public function InstallModule($ModuleName){
        //$IniFile=__DIR__.'\..\..\frontend\config\modules.ini';
        //call the IniObject Class and pass the filename
        $this->lang = parse_ini_file($this->IniUrl, true);
        //create array item with key
        $Item[$ModuleName]=[
            'class'=>"frontend\modules\\".$ModuleName."\\".$ModuleName,
            'defaultRoute' => 'default/index',  
        ];
        //Add the module on database Package
        $Package= Package::find()->where("PackageName='$ModuleName'")->one();
        if(!$Package){
            $Package=new Package(); 
            $Package->PackageName=$ModuleName;
        }
         //Save the Package
        $Package->save();
        //Generate permission
        $AuthItem= AuthItem::find()->where("name='/".$ModuleName."/*'")->one();
        if(!$AuthItem){
            //Create Route
            $AuthItem=new AuthItem();
            $AuthItem->name="/".$ModuleName."/*";
            $AuthItem->type=2;
            $AuthItem->save();
            //create permissions
            $AuthItem2=new AuthItem();
            $AuthItem2->name="access-$ModuleName";
            $AuthItem2->description="This permission allow user to access $ModuleName module";
            $AuthItem2->type=2;
            $AuthItem2->save();
            $AuthItemChild=new AuthItemChild();
            $AuthItemChild->parent="access-$ModuleName";
            $AuthItemChild->child="/".$ModuleName."/*";
            $AuthItemChild->save();
        }
        //save the Ini File passing the array as parameters
        $this->SaveIniFile($this->IniUrl, $this->lang,$Item);
        return "Module '$ModuleName' Successfully Installed.";
    }
    public function GenerateDefaultModuleFiles($ModuleName){
        $ModuleFile=Yii::$app->basePath."../../frontend/modules/$ModuleName/$ModuleName.php";
        $TemplateModulePath=__DIR__.'\template\module.txt';
        $ModuleContents1= file_get_contents($TemplateModulePath);
        $ModuleContents2= str_ireplace('[modulename]', $ModuleName, $ModuleContents1);
        $handle = fopen($ModuleFile, 'w') or die('Cannot open file:  '.$ModuleFile);
        $data = "<?php ".PHP_EOL.$ModuleContents2;
        fwrite($handle, $data);
        fclose($handle);
        $this->GenerateController($ModuleName);
        $this->CopyDefaultIndex($ModuleName);
        $ZipObj=new ZipObject();
        return $ZipObj->Compress($ModuleName);
        //return "Module Successfully Created";
    }
    public function GenerateController($ModuleName){
        $ControllerFile=Yii::$app->basePath."../../frontend/modules/$ModuleName/controllers/DefaultController.php";
        $TemplateControllerPath=__DIR__.'\template\DefaultController.txt';
        $ControllerContent1= file_get_contents($TemplateControllerPath);
        $ControllerContent2= str_ireplace('[modulename]', $ModuleName, $ControllerContent1);
        $handle = fopen($ControllerFile, 'w') or die('Cannot open file:  '.$ModuleFile);
        $data = "<?php ".PHP_EOL.$ControllerContent2;
        fwrite($handle, $data);
        fclose($handle);
    }
    public function CopyDefaultIndex($ModuleName){
        $Source=__DIR__.'\template\index.php';
        $Destination=Yii::$app->basePath."../../frontend/modules/$ModuleName/views/default/index.php";
        copy($Source,$Destination);
    }
    /**
     * Create module
     * @param string $moduleName parameter passed
     * @description The name of the module to be created,
     */
    public function CreateDefaultModule($moduleName){
        $ModuleFolderPath=Yii::$app->basePath.'../../frontend/modules/'.$moduleName;
        if(!file_exists($ModuleFolderPath)){
            mkdir($ModuleFolderPath);
        }
        $ControllerFolder=$ModuleFolderPath."/controllers";
        //Create Controllers Folder
        if(!file_exists($ControllerFolder)){
            mkdir($ControllerFolder);
        }
        $ViewsFolder=$ModuleFolderPath."/views";
        if(!file_exists($ViewsFolder)){
            mkdir($ViewsFolder);
        }
        $defaultFolder=$ModuleFolderPath."/views/default";
        if(!file_exists($defaultFolder)){
            mkdir($defaultFolder);
        }
        return "Module Successfully Created.";
    }

}
