<?php

namespace frontend\modules\docman\controllers;

use frontend\modules\docman\components\SynologyService;

use Yii;
use common\models\docman\Issuance;
use common\models\docman\IssuanceSearch;
use common\models\docman\Issuancetype;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * IssuanceController implements the CRUD actions for Issuance model.
 */
class IssuanceController extends Controller
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
     * Lists all Issuance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $issuance_type_id = $_GET['issuance_type_id'];
        
        $searchModel = new IssuanceSearch();
        $searchModel->issuance_type_id = $issuance_type_id;
        $searchModel->year = $_GET['year'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Issuance model.
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
     * Displays a single Issuance model.
     * @param integer $id
     * @return mixed
     */
    public function actionDownload($id, $year)
    {
        $model = $this->findModel($id);
        $type = $model->type->code."/";

        $filename = $model->file;

        $username = "dost9ict";
        $password = "D057R3g10n9";
        $filePath = "/Fileserver/1_ORD/Issuances/".$type.$year."/".$filename;

        $sid = SynologyService::login($username, $password);

        if ($sid) {
            $fileContent = SynologyService::downloadFile($sid, $filePath);
        
            if ($fileContent) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
                Yii::$app->response->headers->add('Content-Type', 'application/octet-stream');
                Yii::$app->response->headers->add('Content-Disposition', 'attachment; filename="' . basename($filePath) . '"');
                return $fileContent;
            } else {
                Yii::$app->response->statusCode = 500;
                return 'Error downloading file';
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return $sid; // return detailed error message from SynologyService::login
        }
        
        // if ($sid) {
        //     $fileContent = SynologyService::downloadFile($sid, $filePath);

        //     if ($fileContent) {
        //         header('Content-Type: application/octet-stream');
        //         header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        //         echo $fileContent;
        //     }

        // } else {
        //     echo "Login failed.";
        // }
    }

    /**
     * Creates a new Issuance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Issuance();
        $types = ArrayHelper::map(Issuancetype::find()->all(),'issuance_type_id','name');
        date_default_timezone_set('Asia/Manila');
        $model->date=date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->user_id;

            // Handle file upload
            $uploadedFile = UploadedFile::getInstance($model, 'file');
            if ($uploadedFile) {
                // Generate the path for Synology based on the type and year
                $type = $model->type->code;  // Assuming issuance_type_id is the type
                $year = date('Y'); // Or fetch the relevant year if it's not the current one

                // $synologyFilePath = "/Fileserver/1_ORD/Issuances/".$type."/".$year."/".$uploadedFile->name;
                $synologyFilePath = "/Fileserver/1_ORD/Issuances/Memo/2023/".$uploadedFile->name;

                // Save the uploaded file temporarily to the local server
                $tempPath = Yii::getAlias('@uploads') . "/docman/issuance/" . $uploadedFile->name;
                // $tempPath = Yii::getAlias('@webroot/uploads/') . $uploadedFile->name;
                $uploadedFile->saveAs($tempPath);
            
                // Upload to Synology
                $synologyService = new SynologyService();
                // $sid = $synologyService::login('dost9ict', 'D057R3g10n9');
                $sid = 'HJzgHBDq_vzkkNiORqCjsouBw2_B6owcHOS7QOki7yY54SO-xIrb3MOb5Ck2MdjJdhqFMdGAsNkSFsF-7kJ-OA';

                if ($sid) {
                    $uploadResult = SynologyService::uploadFile($sid, $tempPath, $synologyFilePath);
                    // var_dump($uploadResult);
                    $model->file = $uploadedFile->name;
                    if (isset($uploadResult['success']) && $uploadResult['success']) {
                        // Save only filename in the database
                        
                        if (!$model->save()) {
                            \Yii::error("Error saving filename to database: " . json_encode($model->getErrors()));
                            // Optionally: Show a message to the user about the error
                        }
                    } else {
                        $errorMessage = isset($uploadResult['message']) ? $uploadResult['message'] : 'Unknown error during file upload';
                        \Yii::error("Error uploading file to Synology: " . $errorMessage);
                        // Optionally: Show a message to the user about the upload error
                    } 
                } else {
                    \Yii::error("Failed to login to Synology Service.");
                }
            }

            if($model->save(false)){
                return $this->redirect(['view', 'id' => $model->issuance_id]);   
            }

        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
                'types' => $types,
            ]);
        } else {
            return $this->render('_form', [
                'model' => $model,
                'types' => $types,
            ]);
        }
    }

    /**
     * Creates a new Issuance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Issuance();
        $types = ArrayHelper::map(Issuancetype::find()->all(), 'issuance_type_id', 'name');

        date_default_timezone_set('Asia/Manila');
        $model->date = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->user_id;
            
            // Assuming 'file' is the name of your file input field in the form
            $uploadedFile = UploadedFile::getInstance($model, 'file');

            if ($uploadedFile) {
                // Adjust these details accordingly
                $localFilePath = Yii::getAlias('@uploads') . "/docman/issuance/" . $uploadedFile->name;
                // $localFilePath = 'temp_directory/' . $uploadedFile->name; // Temporary storage
                $uploadedFile->saveAs($localFilePath);

                $type = 'Memo';  // Get the 'type' variable based on your logic
                $year = 2023;  // Get the 'year' variable based on your logic

                $synologyFilePath = "/Fileserver/1_ORD/Issuances/" . $type . "/" . $year . "/" . $uploadedFile->name;
                $sid = SynologyService::login('dost9ict', 'D057R3g10n9');

                if ($sid) {
                    // Assuming the SynologyService::uploadFile method exists
                    $uploadResult = SynologyService::uploadFile($sid, $synologyFilePath, $localFilePath);

                    if (isset($uploadResult['success']) && $uploadResult['success']) {
                        // Save only filename in the database
                        $model->file = $uploadedFile->name;
                        if (!$model->save()) {
                            \Yii::error("Error saving filename to database: " . json_encode($model->getErrors()));
                            // Optionally: Show a message to the user about the error
                        }
                    } else {
                        $errorMessage = isset($uploadResult['message']) ? $uploadResult['message'] : 'Unknown error during file upload';
                        \Yii::error("Error uploading file to Synology: " . $errorMessage);
                        // Optionally: Show a message to the user about the upload error
                    }
                } else {
                    \Yii::error("Failed to login to Synology Service.");
                    // Optionally: Show a message to the user about the login error
                }
            }

            if (!$model->hasErrors()) {
                return $this->redirect(['view', 'id' => $model->issuance_id]);
            }
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
                'types' => $types,
            ]);
        } else {
            return $this->render('_form', [
                'model' => $model,
                'types' => $types,
            ]);
        }
    }*/

    /**
     * Updates an existing Issuance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->issuance_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Issuance model.
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
     * Finds the Issuance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Issuance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Issuance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
