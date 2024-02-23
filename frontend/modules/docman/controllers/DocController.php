<?php

namespace frontend\modules\docman\controllers;

use Yii;
use common\models\docman\Doc;
use common\models\docman\DocSearch;
use common\models\docman\DocCategorySearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\docman\Docattachment;
use common\models\docman\Doccategory;
use common\models\docman\Section;

use kartik\helpers\Html;
use yii\helpers\Url;

use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\web\UploadedFile;
/**
 * DocController implements the CRUD actions for Doc model.
 */
class DocController extends Controller
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
     * Lists all Doc models.
     * @return mixed
     */
    public function actionIndex2()
    {
        $subcategory_id = $_GET['subcategory_id'];

        $subCategory = Subcategory::findOne($subcategory_id);

        $searchModel = new DocSearch();
        $searchModel->subcategory_id = $subcategory_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'subCategory' => $subCategory,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        $section_id = $_GET['section_id'];

        $section = Section::findOne($section_id);

        $searchModel = new DocSearch();
        $searchModel->section_id = $section_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'section' => $section,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCategory()
    {
        $category = Doccategory::findOne($_GET['category_id']);
        $sections = Section::find()->where('doccategory_id = :doccategory_id',[':doccategory_id' => $_GET['category_id']])->all();
        $searchModel = new DocCategorySearch();
        $searchModel->doccategory_id = $_GET['category_id'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('category', [
            'category' => $category,
            'sections' => $sections,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doc model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id); 
        $_code = $model->code;

        $attachmentsDataProvider = new ActiveDataProvider([
            'query' => $model->getAttachments(),
            'pagination' => false,
        ]);

        if ($model->load(Yii::$app->request->post()))
        {
            $model->effectivity_date = date("Y-m-d", strtotime($_POST['Doc']['effectivity_date']));
            if ($model->save(false))
            {
                // if($_document_code != $model->document_code){
                //     $oldPath = Yii::getAlias('@uploads') . "/docman/document/" . $_document_code;
                //     $newPath = Yii::getAlias('@uploads') . "/docman/document/" . $model->document_code;
                //     rename( $oldPath, $newPath);
                // }

                Yii::$app->session->setFlash('kv-detail-success', 'Request Updated!');
            }else{
                Yii::$app->session->setFlash('error', print_r($model->getErrors()));
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'attachmentsDataProvider' => $attachmentsDataProvider,
        ]);
    }

    /**
     * Creates a new Doc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Doc();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->doc_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Doc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->doc_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Doc model.
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
     * Finds the Doc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Doc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Doc::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUploadattachment($id)
    {
        // Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/uploads/';
        $model = Docattachment::findOne($id);
        date_default_timezone_set('Asia/Manila');
        
        if (Yii::$app->request->post()) {
            // $random = Yii::$app->security->generateRandomString(40);
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            
            //$path = Yii::getAlias('@uploads') . "/docman/document/" . $model->document->document_id;
            $path = Yii::getAlias('@uploads') . "/docman/9001/" . $model->document->section->doccategory->folder . '/' . $model->document->section->section_id . '/' . $model->filename;
            if(!file_exists($path)){
                mkdir($path, 0755, true);
                $indexFile = fopen($path.'/index.php', 'w') or die("Unable to open file!");
            }
                
            // $model->pdfFile->saveAs( $path ."/". $model->doc_attachment_id . '.' . $model->pdfFile->extension);
            $model->pdfFile->saveAs( $path );

            $model->filename = $model->doc_attachment_id . $random . '.' . $model->pdfFile->extension;
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
