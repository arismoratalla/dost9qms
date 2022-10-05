<?php

namespace frontend\modules\docman\controllers;

use Yii;
use common\models\docman\Document;
use common\models\docman\Documentattachment;
use common\models\docman\DocumentSearch;
use common\models\docman\Documenttype;
use common\models\docman\Category;
use common\models\docman\Functionalunit;
use common\models\docman\Qmstype;

use kartik\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\web\UploadedFile;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $searchModel->qms_type_id = $_GET['qms_type_id'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $qmstype = Qmstype::findOne(['qms_type_id'=> $_GET['qms_type_id']]);
        
        $category_menus = '';
        $categories = Category::find()->limit(3)->all();
        foreach($categories as $category){
            $category_menus .= Html::button($category->code, ['title' => 'Approved', 'class' => 'btn btn-success', 'style'=>'width: 90px; margin-right: 6px;']);
        }
        
        $toolbars = '';
        $units = Functionalunit::findAll(['qms_type_id'=> $_GET['qms_type_id']]);
        foreach($units as $unit){
            $toolbars .= Html::button($unit->code, ['title' => 'Approved', 'class' => 'btn btn-info', 'style'=>'width: 90px; margin-right: 6px;']);
        }
            
        return $this->render('index', [
            'qmstype'=>$qmstype,
            'category_menus'=>$category_menus,
            'toolbars'=>$toolbars,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
        /**
     * Lists all Document models.
     * @return mixed
     */
    public function actionFormsindex()
    {
        $searchModel = new DocumentSearch();
        $searchModel->category_id = 4;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        /*$qmstype = Qmstype::findOne(['qms_type_id'=> $_GET['qms_type_id']]);
        
        $category_menus = '';
        $categories = Category::find()->limit(3)->all();
        foreach($categories as $category){
            $category_menus .= Html::button($category->code, ['title' => 'Approved', 'class' => 'btn btn-success', 'style'=>'width: 90px; margin-right: 6px;']);
        }
        
        $toolbars = '';
        $units = Functionalunit::findAll(['qms_type_id'=> $_GET['qms_type_id']]);
        foreach($units as $unit){
            $toolbars .= Html::button($unit->code, ['title' => 'Approved', 'class' => 'btn btn-info', 'style'=>'width: 90px; margin-right: 6px;']);
        }*/
            
        return $this->render('formsindex', [
//            'qmstype'=>$qmstype,
//            'category_menus'=>$category_menus,
//            'toolbars'=>$toolbars,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id); 
        
        $attachmentsDataProvider = new ActiveDataProvider([
            'query' => $model->getAttachments(),
            'pagination' => false,
        ]);
        
        return $this->render('view', [
            'model' => $model,
            'attachmentsDataProvider' => $attachmentsDataProvider,
        ]);
    }

    /**
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->user_id;
            $model->active = 1;
            if($model->save(false)){
                $doc_types = Documenttype::find()->where('active =:active',[':active'=>1])->all();
                    foreach($doc_types as $doc_type){
                        $attachment = new Documentattachment();
                        $attachment->document_id = $model->document_id;
                        $attachment->filename = '';
                        $attachment->document_type = $doc_type->document_type_id;
                        $attachment->last_update = $doc_type->document_type_id;
                        $attachment->save(false);
                    }

                return $this->redirect(['view', 'id' => $model->document_id]);   
            }
                 
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('_form', [
                        'model' => $model,
            ]);
        }
        
    }


    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->document_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Document model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionUploadattachment($id)
    {
        //Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/uploads/';
        $model = Documentattachment::findOne($id);
        date_default_timezone_set('Asia/Manila');
        
        if (Yii::$app->request->post()) {
            $random = Yii::$app->security->generateRandomString(40);
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            
            //$path = Yii::getAlias('@uploads') . "/docman/document/" . $model->document->document_id;
            $path = Yii::getAlias('@uploads') . "/docman/document/" . $model->document->document_code;
            if(!file_exists($path)){
                mkdir($path, 0755, true);
                $indexFile = fopen($path.'/index.php', 'w') or die("Unable to open file!");
            }
                
            $model->pdfFile->saveAs( $path ."/". $model->document_attachment_id . $random . '.' . $model->pdfFile->extension);
            $model->filename = $model->document_attachment_id . $random . '.' . $model->pdfFile->extension;
            $model->last_update = date("Y-m-d H:i:s");
            $model->save(false);
            
            Yii::$app->session->setFlash('success', 'Document Successfully Uploaded!');
            
            return $this->redirect(['view?id='.$model->document_id]);
        }
        
        if (Yii::$app->request->isAjax) {
                return $this->renderAjax('_upload', ['model'=>$model]);   
        }else {
            return $this->render('_upload', [
                        'model' => $model,
            ]);
        }
    }
}
