<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_profile".
 *
 * @property integer $profile_id
 * @property integer $user_id
 * @property string $lastname
 * @property string $firstname
 * @property string $designation
 * @property string $middleinitial
 * @property integer $division_id
 * @property integer $unit_id
 * @property string $contact_numbers
 * @property string $image_url
 * @property string $avatar
 * @property string $esig
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'lastname', 'firstname', 'designation', 'division_id', 'unit_id'], 'required'],
            [['user_id', 'division_id', 'unit_id'], 'integer'],
            [['lastname', 'firstname', 'designation', 'middleinitial'], 'string', 'max' => 50],
            [['contact_numbers', 'image_url', 'avatar', 'esig'], 'string', 'max' => 100],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profile_id' => 'Profile ID',
            'user_id' => 'User ID',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'designation' => 'Designation',
            'middleinitial' => 'Middleinitial',
            'division_id' => 'Division ID',
            'unit_id' => 'Unit ID',
            'contact_numbers' => 'Contact Numbers',
            'image_url' => 'Image Url',
            'avatar' => 'Avatar',
            'esig' => 'Esig',
        ];
    }
    
    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['division_id' => 'division_id']);
    }

    public function getUnit()
    {
        return $this->hasOne(Functionalunit::className(), ['functional_unit_id' => 'unit_id']);
    }

    public function getuser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
