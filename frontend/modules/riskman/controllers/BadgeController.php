<?php

namespace frontend\modules\riskman\controllers;

use Yii;
use common\models\riskman\Badge;
use common\models\riskman\BadgeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BadgeController implements the CRUD actions for Badge model.
 */
class BadgeController extends Controller
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
     * Lists all Badge models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BadgeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Badge model.
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
     * Creates a new Badge model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Badge();
        $model->module_id = $_GET['module_id'];
        if ($model->load(Yii::$app->request->post())) {
            
            // $random = Yii::$app->security->generateRandomString(40);
            $model->icon = UploadedFile::getInstance($model, 'icon');

            $path = Yii::getAlias('@uploads') . "/".Yii::$app->controller->module->id."/badges/";
            if(!file_exists($path)){
                mkdir($path, 0755, true);
                $indexFile = fopen($path.'/index.php', 'w') or die("Unable to open file!");
            }
                
            $model->icon->saveAs( $path ."/". $model->icon . '.' . $model->icon->extension);

            $model->save(false);
            
            Yii::$app->session->setFlash('success', 'Badge Successfully Added!');

            return $this->redirect(['index', 'module_id' => Yii::$app->controller->module->id]);

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
     * Updates an existing Badge model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->badge_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Badge model.
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
     * Finds the Badge model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Badge the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Badge::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
