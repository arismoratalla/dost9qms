<?php

namespace backend\controllers;

use Yii;
use common\models\system\Profile;
use common\models\system\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
    public function actions()
    {
        return [
            'uploadPhoto' => [
                'class' => 'budyaga\cropper\actions\UploadAction',
                'url' => 'http://admin.eulims.local/upload/user/photo',
                'path' => '@frontend/web/uploads/user/photo',
            ]
        ];
    }
    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
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
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->params['uploadPath'] = realpath(dirname(__FILE__)).'\..\..' . '\backend\web\uploads\user\photo\\';
        $model = new Profile();
        $HasImage=false;
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if($image){
                // store the source file name
                $model->image_url = $image->name;
                $ext = end((explode(".", $image->name)));
                // generate a unique file name
                $model->avatar = hash('haval160,4',$model->user_id).".{$ext}";
                $path = Yii::$app->params['uploadPath'] . $model->avatar;
                $HasImage=true;
            }
            if($model->validate() && $model->save()){
                if($HasImage){
                    $image->saveAs($path);
                }
                //return "Saved...";
                return $this->redirect(['view', 'id'=>$model->user_id]);
            }else{
                //Yii::$app->getSession()->setFlash('danger','Duplicate Entry, Username is Unique');
                //Yii::$app->session->setFlash('danger', "Duplicate Entry, Username is Unique");
                return $this->render('create', [
                   'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //var_dump(Yii::$app->request->post());
        //exit;
        Yii::$app->params['uploadPath'] = realpath(dirname(__FILE__)).'\..\..' . '\backend\web\uploads\user\photo\\';
        if(Yii::$app->user->can('access-his-profile')){
            if($id==\Yii::$app->user->identity->user_id){
                $mId=$id;
            }else{
                $mId=-1;
            }
        }else{
           $mId=$id; 
        }
        $model = $this->findModel($mId);
        $OldAvatar=$model->avatar;
        $OldImageUrl=$model->image_url;
        $changeImage=false;
        if ($model->load(Yii::$app->request->post())) {
                $image = UploadedFile::getInstance($model, 'image');
                if($image){
                    // store the source file name
                    $model->image_url = $image->name;
                    $ext = end((explode(".", $image->name)));
                    // generate a unique file name
                    $model->avatar = hash('haval160,4',$model->user_id).".{$ext}";
                    $path = Yii::$app->params['uploadPath'] . $model->avatar;
                    $changeImage=true;
                }
                $NewImageUrl=$model->image_url;
                if($model->avatar==''){
                    $model->avatar=$model->avatar=='' ? null : $model->avatar;
                    $model->image_url=$model->image_url=='' ? null : $model->$model->image_url;
                }
            if($model->save()){
                if($changeImage){
                    $image->saveAs($path);
                }elseif($OldImageUrl!='' && $NewImageUrl==''){
                    //Unlink Image
                    //unlink(Yii::$app->params['uploadPath'].$OldAvatar);
                    $this->actionDeleteimage($OldAvatar);
                }
                //return "Saved...";
                return $this->redirect(['view', 'id'=>$model->user_id]);
            } else {
                // error in saving model
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionDeleteimage($avatar){
        unlink(Yii::$app->params['uploadPath'].$avatar);
    }
    /**
     * Deletes an existing Profile model.
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
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested profile does not exist or you are not permitted to view this profile.');
        }
    }
}
