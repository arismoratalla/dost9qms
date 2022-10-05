<?php

namespace backend\controllers;
use Yii;
use common\components\IniObject;
use common\components\ZipObject;
use common\models\system\UploadPackage;
use yii\web\UploadedFile;
use common\models\system\PackageSearch;
use common\models\system\Package;

class PackageController extends \yii\web\Controller
{
    /**
     * Lists all Package models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PackageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Package model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Updates an existing Package model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PackageID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionGetcss() {
        $functions=new functions();
        $Fonts=$functions->ToArray();
        foreach($Fonts as $Font){
            echo $Font;
        }
       /* $rules = [];
        $cssfile="http://localhost/eulims/backend/web/assets/d790e64c/css/font-awesome.min.css";
        $css= file_get_contents($cssfile);
        $css = str_replace("\r", "", $css); // get rid of new lines
        $css = str_replace("\n", "", $css); // get rid of new lines
// explode() on close curly braces
// We should be left with stuff like:
//   span{//whatever
//   .block{//whatever
        $first = explode('}', $css);

// If a } didn't exist then we probably don't have a valid CSS file
        if ($first) {
            // Loop each item
            foreach ($first as $v) {
                // explode() on the opening curly brace and the ZERO index should be the class declaration or w/e
                $second = explode('{', $v);

                // The final item in $first is going to be empty so we should ignore it
                if (isset($second[0]) && $second[0] !== '') {
                    $rules[] = trim($second[0]);
                }
            }
        }

// Enjoy the fruit of PHP's labor :-)
        print_r($rules);
        * 
        */
    }

    /**
     * Finds the Package model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Package the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Package::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionManager()
    {
        $model = new UploadPackage();
        return $this->render('manager', [
            'model' => $model,
        ]);
    }
    public function actionUpload()
    {
        $model = new UploadPackage();
        if ($model->load(Yii::$app->request->post())) {
            $model->upload = UploadedFile::getInstance($model, 'upload');
            if($model->upload){
                $model->package_name=$model->upload->name;
                //$ext = end((explode(".", $model->upload->name)));
                $model->module_name= ucwords($model->upload->name);
                $filePath =__DIR__.'\..\..\backend\web\uploads\packages\\'. $model->upload->name;
                $model->upload->saveAs($filePath);
                $model->save(false);
                //return json_encode($filePath);
                return $this->redirect('/package');
            }
        }
    }
    
    public function actionWriteini(){
        //get the path of config file
        $IniFile=__DIR__.'\..\..\frontend\config\modules.ini';
        //call the IniObject Class and pass the filename
        $IniArray=new IniObject($IniFile);
        //create array item with key
        $Item['inventory']=[
            'class'=>'frontend\modules\inventory\inventory',
            'defaultRoute' => 'default/index',  
        ];
       
        //save the Ini File passing the array as parameters
        $ret=$IniArray->SaveIniFile($IniFile,$IniArray->lang,$Item);
        echo $ret;
    }
    public function actionExtract(){
        $post=\Yii::$app->request->post();
        $zipfile=$post['url'];
        //return $zipfile;
        $zip=new ZipObject($zipfile);
        return $zip->Extract();
    }
    public function actionRemovemodule(){
        $post=\Yii::$app->request->post();
        $zipfile=$post['url'];
        $PackageName= basename($zipfile,".zip");
        //$PackageName= $post['pack'];
        $IniObj=new IniObject();
        return $IniObj->RemoveModule($PackageName);
    }
    public function actionExport(){
        $post=\Yii::$app->request->post();
        $ModuleName=$post['pack'];
        $zip=new ZipObject();
        return $zip->Compress($ModuleName);
    }
    public function actionCreatemodule(){
        $post=\Yii::$app->request->post();
        $ModuleName=$post['modname'];
        $IniObj=new IniObject();
        //create the folder
        $IniObj->CreateDefaultModule($ModuleName);
        //return $ModuleName;
        $IniObj->InstallModule($ModuleName);
        return $IniObj->GenerateDefaultModuleFiles($ModuleName);
    }
}
