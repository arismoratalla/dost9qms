<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\system\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\components\SwiftMessage;
use common\models\system\User;
use dosamigos\google\places\Search;
use common\models\auth\AuthAssignment;
use common\models\system\Profile;
use yii\db\Query;
//use common\models\inventory\Products;
use common\models\inventory\Categorytype;
use common\models\inventory\Producttype;
//use yii\swiftmailer\Message;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup','requestpasswordreset'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /*
    public function actionQuery(){
        $inventorydb= Yii::$app->get('inventorydb');
        /*$query=new Query();
        $query->select(['`product_code`, `product_name`, `tbl_producttype`.`producttype`,`tbl_categorytype`.`categorytype`'])
                ->from('`tbl_products`')
                ->innerJoin('`tbl_producttype`', '`tbl_producttype`.`producttype_id`=`tbl_products`.`producttype_id`')
                ->innerJoin('`tbl_categorytype`', '`tbl_categorytype`.`categorytype_id`=`tbl_products`.`categorytype_id`')
                ->where(['`tbl_products`.`product_id`'=>2]);
        $command=$query->createCommand($inventorydb);
        $products=$command->queryAll();
         * 
         */
        /*
        $products= Products::find()
                ->innerJoin('`tbl_producttype`', '`tbl_producttype`.`producttype_id`=`tbl_products`.`producttype_id`')
                ->innerJoin('`tbl_categorytype`', '`tbl_categorytype`.`categorytype_id`=`tbl_products`.`categorytype_id`')
                ->where(['`tbl_products`.`product_id`'=>1])
                ->all();
        echo "<pre>";
        print_r($products);
        echo "</pre>";
    }*/
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex(){
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about'); 
    }
    public function actionSendmail(){
        $mailer= \Yii::$app->mailer;
        $mailer->compose('sampleEmail-html', ['message' => 'Nolan'])
                ->setFrom('nolansunico@gmail.com')
                ->setTo('nolansunico@gmail.com')
                ->setBcc('nolan@tailormadetraffic.com')
                ->attach('d:/attachment.png')
                ->attach('d:/Sample.txt')
                ->setReplyTo('admin@eulims.com')
                ->setSubject('This message was sent to you by: ' . \Yii::$app->name)
                ->send();
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user=$model->signup()) {
                //Send email Verification
                $model->SendEmail($user);
                return $this->runAction('success', ['model' => $user]);
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    public function actionSuccess($model){
        return $this->render('success', [
            'model' => $model,
        ]);
    }
    public function actionVerify(){
        $get= Yii::$app->request->get();
        $user= User::find()->where("md5(user_id)='".$get['id']."'")->one();
        if ($user) {
            $mUser= User::findOne(['user_id'=>$user->user_id]);
            //Update User
            $mUser->status = 10;
            $mUser->save();
            //Assign default Role  basic-role
            $BasicRole = 'basic-role';
            //search existing assignment
            $AAssignment= AuthAssignment::find()->where(['item_name'=>$BasicRole]);
            if (!$AAssignment) {
                $AuthAssignment = new AuthAssignment();
                $AuthAssignment->item_name = $BasicRole;
                $AuthAssignment->user_id = (string) $user->user_id;
                $AuthAssignment->save();
            }
            return $this->render('verify');
        }else{
            return $this->render('expired');
        }
        
    }
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestpasswordreset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
