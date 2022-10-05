<?php

namespace common\models\employeecompensation;

use Yii;

/**
 * This is the model class for table "tbl_payroll".
 *
 * @property integer $payroll_id
 * @property integer $obligation_type_id
 * @property string $payroll_date
 * @property integer $created_by
 */
class Payroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_payroll';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('procurementdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['obligation_type_id', 'payroll_date', 'created_by'], 'required'],
            [['obligation_type_id', 'created_by'], 'integer'],
            [['payroll_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payroll_id' => 'Payroll ID',
            'obligation_type_id' => 'Obligation Type ID',
            'payroll_date' => 'Payroll Date',
            'created_by' => 'Created By',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayrollItems()
    {
        return $this->hasMany(Payrollitem::className(), ['payroll_id' => 'payroll_id']);
        //return $this->hasMany(Payrollitem::className(), ['payroll_id' => 'payroll_id'])->andOnCondition(['active' => 1]);
    }
}
