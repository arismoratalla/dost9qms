<?php

namespace common\models\procurement;

use common\models\system\Profile;
use common\models\system\User;
use Yii;

/**
 * This is the model class for table "tbl_division_head".
 *
 * @property integer $division_head_id
 * @property integer $division_id
 * @property integer $user_id
 *
 * @property Division $division
 * @property User $user
 */
class Divisionhead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_division_head';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['division_id', 'user_id'], 'required'],
            [['division_id', 'user_id'], 'integer'],
            [['division_id'], 'exist', 'skipOnError' => true, 'targetClass' => Division::className(), 'targetAttribute' => ['division_id' => 'division_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'division_head_id' => 'Division Head ID',
            'division_id' => 'Division ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['division_id' => 'division_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
    
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }
}
