<?php

namespace frontend\modules\docman\controllers;
use common\models\system\User;

use Yii;
use common\models\docman\Document;
use common\models\docman\Documentattachment;
use common\models\docman\DocumentSearch;
use common\models\docman\Documenttype;
use common\models\docman\Category;
use common\models\docman\Functionalunit;
use common\models\docman\Qmstype;

use kartik\helpers\Html;
use yii\helpers\Url;
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
        $allowed = false;

        if($_GET['qms_type_id'] == 1){
            if( Yii::$app->user->can('9001-basic-role') || Yii::$app->user->can('9001-auditor') || Yii::$app->user->can('9001-document-custodian') )
                $allowed = true;
        }

        if($_GET['qms_type_id'] == 2){
            if( Yii::$app->user->can('17025-basic-role') || Yii::$app->user->can('17025-auditor') || Yii::$app->user->can('17025-document-custodian') )
                $allowed = true;
        }

        if(Yii::$app->user->identity->username == 'Admin'){
            $allowed = true;
        }

        if($allowed){ 
            $user = User::findOne(['user_id'=> Yii::$app->user->identity->user_id]);

            $searchModel = new DocumentSearch();
            $searchModel->qms_type_id = $_GET['qms_type_id'];
            /*if( !(Yii::$app->user->can('17025-document-custodian') || (Yii::$app->user->identity->username == 'Admin') ) ){
                $searchModel->functional_unit_id = $user->profile->unit_id;
                $searchModel->category_id = 1;
            }*/
            switch ($_GET['qms_type_id']) {
                case 1:
                    $filter_categories = Category::find()->where(['in', 'category_id', [1,2,3,11]])->orderBy(['num'=>SORT_ASC])->all();
                    break;
                case 2:
                    $filter_categories = Category::find()->where(['in', 'category_id', [1,2,3,4,5,6,7,8,9,10]])->orderBy(['num'=>SORT_ASC])->all();
                    
                    break;
                default:
                    $filter_categories = Category::find()->orderBy(['num'=>SORT_ASC])->all();
            }

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            
            $qmstype = Qmstype::findOne(['qms_type_id'=> $_GET['qms_type_id']]);

            $color = [
                1 => 'color: #B76E79',
                2 => 'color: #B76E79',
                3 => 'color: #B76E79',
                4 => 'color: #B76E79',
                5 => 'color: #B76E79',
                6 => 'color: #B76E79',
                7 => 'color: #B76E79',
                8 => 'color: #B76E79',
                9 => 'color: #B76E79',
                10 => 'color: #B76E79',
                11 => 'color: #B76E79',
                12 => 'color: #B76E79',
                13 => 'color: #B76E79',
                14 => 'color: #B76E79',
                15 => 'color: #B76E79',
                16 => 'color: #B76E79',
                17 => 'color: #B76E79',
                18 => 'color: #8A9A5B',
                19 => 'color: #00FFFF',
                20 => 'color: #B76E79',
            ];

            $category_menus = '';
            $categories = Category::find()->limit(3)->all();
            foreach($categories as $category){
                //$category_menus .= Html::button($category->code, ['title' => 'Approved', 'class' => 'btn btn-success', 'style'=>'width: 90px; margin-right: 6px;']);
                $category_menus .= Html::a($category->code, ['index?qms_type_id='.$_GET['qms_type_id'].'&DocumentSearch[category_id]='.$category->category_id], [
                    'class' => 'btn btn-outline-secondary',
                    'data-pjax' => 0, 
                ]);
            }
            
            $toolbars = '';
            if( !(Yii::$app->user->can('17025-document-custodian') || (Yii::$app->user->identity->username == 'Admin') ) )
                $units = Functionalunit::findAll(['qms_type_id'=> $_GET['qms_type_id'], 'functional_unit_id'=>$user->profile->unit_id]);
            else
                $units = Functionalunit::findAll(['qms_type_id'=> $_GET['qms_type_id']]);

            foreach($units as $unit){
                //$toolbars .= Html::button($unit->code, ['value' => Url::to(['document/index', 'DocumentSearch[functional_unit_id]' => $unit->functional_unit_id]), 'title' => 'Approved', 'class' => 'btn btn-info', 'style'=>'width: 90px; margin-right: 6px;']);
                $toolbars .= Html::a($unit->code, ['index?qms_type_id='.$_GET['qms_type_id'].'&DocumentSearch[functional_unit_id]='.$unit->functional_unit_id], [
                    'class' => 'btn btn-outline-secondary',
                    'style' => $color[$unit->functional_unit_id],
                    'data-pjax' => 0, 
                ]);
            }
                return $this->render('index', [
                    'qmstype'=>$qmstype,
                    'category_menus'=>$category_menus,
                    'toolbars'=>$toolbars,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'filter_categories' => $filter_categories,
                ]);
        }else{
            return $this->render('restricted');
        }
    }
    
        /**
     * Lists all Document models.
     * @return mixed
     */
    public function actionFormsindex()
    {
        $searchModel = new DocumentSearch();
        $searchModel->category_id = 11;
        $searchModel->qms_type_id = $_GET['qms_type_id'];
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
        $_document_code = $model->document_code;

        $attachmentsDataProvider = new ActiveDataProvider([
            'query' => $model->getAttachments(),
            'pagination' => false,
        ]);
        
        if ($model->load(Yii::$app->request->post()))
        {
            $model->effectivity_date = date("Y-m-d", strtotime($_POST['Document']['effectivity_date']));
            if ($model->save(false))
            {
                if($_document_code != $model->document_code){
                    $oldPath = Yii::getAlias('@uploads') . "/docman/document/" . $_document_code;
                    $newPath = Yii::getAlias('@uploads') . "/docman/document/" . $model->document_code;
                    rename( $oldPath, $newPath);
                }

                Yii::$app->session->setFlash('kv-detail-success', 'Request Updated!');
            }else{
                Yii::$app->session->setFlash('error', print_r($model->getErrors()));
            }
        }
        
        
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
        $qms_type_id = $_GET['qms_type_id'];
        
        switch ($qms_type_id) {
            case 1:
                $categories = Category::find()->where(['in', 'category_id', [1,2,3,11]])->orderBy(['num'=>SORT_ASC])->all();
                break;
            case 2:
                $categories = Category::find()->where(['in', 'category_id', [1,2,3,4,5,6,7,8,9,10]])->orderBy(['num'=>SORT_ASC])->all();
                
                break;
            default:
                $categories = Category::find()->orderBy(['num'=>SORT_ASC])->all();
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->user_id;
            if( isset($_POST['Document']['functional_unit_id']) )
                $model->functional_unit_id = $_POST['Document']['functional_unit_id'];
            else
                $model->functional_unit_id = NULL;

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
                        'qms_type_id' => $qms_type_id,
                        'categories' => $categories,
            ]);
        } else {
            return $this->render('_form', [
                        'model' => $model,
                        'qms_type_id' => $qms_type_id,
                        'categories' => $categories,
            ]);
        }
        
    }

    public function actionCreateform()
    {
        $model = new Document();
        $qms_type_id = $_GET['qms_type_id'];
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->user_id;
            $model->category_id = 11;
            if( isset($_POST['Document']['functional_unit_id']) )
                $model->functional_unit_id = $_POST['Document']['functional_unit_id'];
            else
                $model->functional_unit_id = NULL;

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
            return $this->renderAjax('_form2', [
                        'model' => $model,
                        'qms_type_id' => $qms_type_id,
            ]);
        } else {
            return $this->render('_form2', [
                        'model' => $model,
                        'qms_type_id' => $qms_type_id,
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

    public function actionDownloadattachment($id)
    {
        //Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/uploads/';
        $model = Documentattachment::findOne($id);
        date_default_timezone_set('Asia/Manila');
        
        /*if (Yii::$app->request->post()) {
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
        }*/
        
        if (Yii::$app->request->isAjax) {
                return $this->renderAjax('_download', ['model'=>$model]);   
        }else {
            return $this->render('_download', [
                        'model' => $model,
            ]);
        }
    }
}
