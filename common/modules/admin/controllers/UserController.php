<?php

namespace common\modules\admin\controllers;

use Yii;
use common\models\docman\Division;
use common\models\docman\Functionalunit;
use common\models\docman\Position;
use common\models\docman\Profile;

use common\modules\admin\models\form\Login;
use common\modules\admin\models\form\PasswordResetRequest;
use common\modules\admin\models\form\ResetPassword;
use common\modules\admin\models\form\Signup;
use common\modules\admin\models\form\ChangePassword;
use common\modules\admin\models\User;
use common\modules\admin\models\searchs\User as UserSearch;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\mail\BaseMailer;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\modules\admin\components\Helper;

/**
 * User controller
 */
class UserController extends Controller
{
    private $_oldMailPath;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'logout' => ['post'],
                    'activate' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (Yii::$app->has('mailer') && ($mailer = Yii::$app->getMailer()) instanceof BaseMailer) {
                /* @var $mailer BaseMailer */
                $this->_oldMailPath = $mailer->getViewPath();
                $mailer->setViewPath('@mdm/admin/mail');
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterAction($action, $result)
    {
        if ($this->_oldMailPath !== null) {
            Yii::$app->getMailer()->setViewPath($this->_oldMailPath);
        }
        return parent::afterAction($action, $result);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $profile= Profile::findOne(['user_id'=>$model->user_id]);

        //$model= User::findOne(['id'=>$id]);
        //if ($model->load(Yii::$app->request->post())) {
        

        if ($_POST && $model) {
            $oldPwd=$model->password_hash;
            $obj=Yii::$app->request->post();
            $model->email=$obj['User']['email'];
            $model->username=$obj['User']['username'];
            $model->updated_at=strtotime("now");
            if($oldPwd!=$obj['User']['password_hash']){
                $model->password=$obj['User']['password_hash'];
            }
            $model->save(true);
            Helper::invalidate();
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                    'model' => $model,
                    'profile' => $profile,
            ]);
        }
    }

    public function actionUpdateprofile($id)
    {

        $model = $this->findModel($id);
        $profile= Profile::findOne(['user_id'=>$model->user_id]);

        if ($profile->load(Yii::$app->request->post()))
        {
            $profile->groups = implode(",",$_POST['Profile']['groups']);
            
            if ($profile->save(false))
            {
                Yii::$app->session->setFlash('kv-detail-success', 'Profile Updated!');
            }else{
                Yii::$app->session->setFlash('error', print_r($profile->getErrors()));
            }
        }
        
        return $this->render('update', [
            'model' => $model,
            'profile' => $profile,
    ]);
    }
    
    /**
     * Displays a single User model.
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
     * Activate new user
     * @param integer $id
     * @return type
     * @throws UserException
     * @throws NotFoundHttpException
     */
    public function actionDeactivate($id)
    {
        /* @var $user User */
        $user = $this->findModel($id);
        if ($user->status == User::STATUS_ACTIVE) {
            $user->status = User::STATUS_INACTIVE;
            if ($user->save()) {
                return $this->runAction('view', ['id'=>$id]);
                //return Url::toRoute(['admin/user/view','id'=>$id]);
            } else {
                $errors = $user->firstErrors;
                throw new UserException(reset($errors));
            }
        }
        return $this->goHome();
        //return $this->run("/admin/user/view?id=".$id);
    }
    /**
     * Deletes an existing User model.
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
     * Login
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Logout
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout();

        return $this->goHome();
    }

    /**
     * Signup new user
     * @return string
     */
    public function actionSignup()
    {
        $model = new Signup();
        
        $divisions = Division::find()->all();
        $units = Functionalunit::find()->all();
        $positions = Position::find()->all();

        $listDivisions = ArrayHelper::map($divisions,'division_id','name');
        $listUnits = ArrayHelper::map($units,'functional_unit_id','name');
        $listPositions = ArrayHelper::map($positions,'name','name');
        
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                if(Yii::$app->user->isGuest){
                    
                }else{
                   return $this->run('/admin/user'); 
                } 
            }
        }

        return $this->render('signup', [
                'model' => $model,
                'listDivisions' => $listDivisions,
                'listUnits' => $listUnits,
                'listPositions'=>$listPositions
        ]);
    }

    /**
     * Request reset password
     * @return string
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequest();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                'model' => $model,
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPassword($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                'model' => $model,
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            return $this->goHome();
        }

        return $this->render('change-password', [
                'model' => $model,
        ]);
    }

    /**
     * Activate new user
     * @param integer $id
     * @return type
     * @throws UserException
     * @throws NotFoundHttpException
     */
    public function actionActivate($id)
    {
        /* @var $user User */
        $user = $this->findModel($id);
        if ($user->status == User::STATUS_INACTIVE) {
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                return $this->runAction('view', ['id'=>$id]);
                //return Url::toRoute(['admin/user/view','id'=>$id]);
            } else {
                $errors = $user->firstErrors;
                throw new UserException(reset($errors));
            }
        }
        return $this->goHome();
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionListunit() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = Functionalunit::find()->andWhere(['division_id'=>$id])->asArray()->all();
            $selected  = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $unit) {
                    $out[] = ['id' => $unit['functional_unit_id'], 'name' => $unit['name']];
                    if ($i == 0) {
                        $selected = $unit['functional_unit_id'];
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected'=>$selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected'=>'']);
    }
}
