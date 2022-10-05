<?php
namespace common\modules\admin\models\form;

use Yii;
use common\modules\admin\models\User;
use common\models\system\Profile;
use yii\base\Model;

/**
 * Signup form
 */
class Signup extends Model
{
    public $username;
    public $lastname;
    public $firstname;
    public $middleinitial;
    public $designation;
    public $email;
    public $password;
    public $division_id;
    public $unit_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['firstname', 'required'],
            ['middleinitial', 'required'],
            ['lastname', 'required'],
            ['designation', 'required'],
            ['division_id', 'required'],
            ['unit_id', 'required'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'designation' => 'Designation',
            'middleinitial' => 'Middle Name',
            'division_id' => 'Division',
            'unit_id' => 'Unit',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                $profile = new Profile();
                
                $profile->user_id = $user->user_id;
                $profile->lastname = $this->lastname;
                $profile->firstname = $this->firstname;
                $profile->middleinitial = $this->middleinitial;
                $profile->designation = $this->designation;
                $profile->division_id = $this->division_id;
                $profile->unit_id = $this->unit_id;
                $profile->save(false);
                return $user;
            }
        }

        return null;
    }
}
