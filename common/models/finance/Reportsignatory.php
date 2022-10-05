<?php

namespace common\models\finance;

use Yii;
use common\models\system\User;

/**
 * This is the model class for table "tbl_report_signatory".
 *
 * @property integer $report_signatory_id
 * @property integer $division_id
 * @property string $scope
 * @property string $box
 * @property integer $user1
 * @property integer $user2
 * @property integer $user3
 * @property integer $active_user
 *
 * @property Division $division
 * @property User $user10
 * @property User $user20
 * @property User $user30
 * @property User $activeUser
 */
class Reportsignatory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_report_signatory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['division_id', 'scope', 'box', 'user1', 'user2', 'user3', 'active_user'], 'required'],
            [['division_id', 'user1', 'user2', 'user3', 'active_user'], 'integer'],
            [['scope'], 'string', 'max' => 25],
            [['box'], 'string', 'max' => 1],
            [['division_id'], 'exist', 'skipOnError' => true, 'targetClass' => Division::className(), 'targetAttribute' => ['division_id' => 'division_id']],
            [['user1'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user1' => 'user_id']],
            [['user2'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user2' => 'user_id']],
            [['user3'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user3' => 'user_id']],
            [['active_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['active_user' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'report_signatory_id' => 'Report Signatory ID',
            'division_id' => 'Division ID',
            'scope' => 'Scope',
            'box' => 'Box',
            'user1' => 'User1',
            'user2' => 'User2',
            'user3' => 'User3',
            'active_user' => 'Active User',
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
    public function getUser10()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser20()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser30()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActiveUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'active_user']);
    }
}
