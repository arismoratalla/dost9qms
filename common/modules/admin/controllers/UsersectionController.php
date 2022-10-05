<?php

namespace common\modules\admin\controllers;

use Yii;
use common\models\procurement\Section;
use common\models\procurement\Project;

use common\models\system\Profile;
use common\models\system\Usersection;
use common\models\system\UsersectionSearch;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersectionController implements the CRUD actions for Usersection model.
 */
class UsersectionController extends Controller
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
     * Lists all Usersection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usersection model.
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
     * Creates a new Usersection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->request->post()){
            $posts = Yii::$app->request->post();
            foreach($posts['Usersection']['user_id'] as $user)
            {
                    $model = new Usersection();
                    $model->user_id = $user;
                    $model->section_id = $posts['Usersection']['section_id'];
                    $model->project_id = $posts['Usersection']['project_id'];
                    $model->save();
            }
            Yii::$app->session->setFlash('success', "Users successfully assigned.");
            return $this->redirect(['/admin/group/index']);
        }
        
        $model = new Usersection();
        $users = Profile::find()->orderBy('lastname')->asArray()->all();
        $listUsers = ArrayHelper::map($users, 'user_id', 'firstname');
        
        $sections = Section::find()->orderBy('section_id')->asArray()->all();
        $listSections = ArrayHelper::map($sections, 'section_id', 'name');
        
        $projects = Project::find()->orderBy('project_id')->asArray()->all();
        $listProjects = ArrayHelper::map($projects, 'project_id', 'code');
        
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'model' => $model,
                        'listUsers' => $listUsers,
                        'listSections' => $listSections,
                        'listProjects' => $listProjects,
            ]);
        } else {
            return $this->render('_form', [
                        'model' => $model,
                        'listUsers' => $listUsers,
                        'listSections' => $listSections,
                        'listProjects' => $listProjects,    
            ]);
        }
    }

    /**
     * Updates an existing Usersection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_section_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usersection model.
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
     * Finds the Usersection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usersection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usersection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
