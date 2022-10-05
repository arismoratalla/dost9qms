<?php



namespace common\components;
use Yii;
use ZipArchive;
use common\components\IniObject;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
/**
 * Description of ZipObject
 *
 * @author OneLab
 */
class ZipObject {
    static $zipfilename;
    public $extractfolder=__DIR__.'\..\..\frontend\modules';
    public function __construct($zipfilename=null) {
        if(!$zipfilename==null){
            if(file_exists($zipfilename)){
                self::$zipfilename=$zipfilename;
            }else{
                throw new \yii\web\HttpException(404, 'Zip file "'.basename($zipfilename).'" does not exist.');
            }
        }
    }
    
    public function Extract(){
       $ExtractFolderPath= Yii::$app->basePath.'../../frontend/modules';
       $zip = new ZipArchive();
       $PackageName= basename(self::$zipfilename,".zip");
       $msg="";
       if($zip->open(self::$zipfilename, ZipArchive::ER_READ)){
           if ($zip->extractTo($ExtractFolderPath)) {
                $IniObj=new IniObject();
                $IniObj->InstallModule($PackageName);
                $msg="Module '$PackageName' Successfully Installed.";
                $msg.="<br>Please assign 'access-$PackageName' permission to users to be able to access the module.";
            } else {
                $msg="Failed to install Module.";
            }
        }else{
           $msg="Failed to install Module.";
       }
       $zip->close();
       return $msg;
    }
    public function Compress($ModName){
        $ModuleName= strtolower($ModName);
        $ModuleFolder=Yii::$app->basePath."/../frontend/modules/$ModuleName";
        $ModulePath=\Yii::getAlias('@frontend')."/modules";
        $DestinationZip=Yii::$app->basePath."\web\uploads\packages\\".$ModuleName.".zip";
        $zip = new ZipArchive();
        $zip->open($DestinationZip, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($ModuleFolder),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
    
        foreach ($files as $name => $file){
            // Skip directories (they would be added automatically)
            if (!$file->isDir()){
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($ModulePath)+1);
                // Add current file to archive
                $zip->addfile($filePath,$relativePath);
            }
        }
        // Zip archive will be created only after closing object
        $zip->close();
        return "Module '$ModuleName' Successfully Exported into zip.<br>Location: [$DestinationZip]";
    }
}
