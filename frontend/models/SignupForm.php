<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\system\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\system\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\system\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->status=0;
        $user->generateAuthKey();


        return $user->save() ? $user : null;
    }
    public function SendEmail($model){
        Yii::$app->mailer->compose(['html' => 'register'], ['model' => $model])
            ->setFrom(Yii::$app->params['adminEmail']) 
            ->setTo($model->email)
            ->setCc([Yii::$app->params['supportEmail']])
            ->setSubject('Email Verification for EULIMS')
            ->send();
    }
}
