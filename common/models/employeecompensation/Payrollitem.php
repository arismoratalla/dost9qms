<?php

namespace common\models\employeecompensation;

use Yii;

/**
 * This is the model class for table "tbl_payroll_item".
 *
 * @property integer $payroll_item_id
 * @property integer $payroll_id
 * @property integer $creditor_id
 * @property string $salary
 * @property string $gross_amount_earned
 */
class Payrollitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_payroll_item';
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
            [['payroll_id', 'creditor_id', 'salary', 'gross_amount_earned'], 'required'],
            [['payroll_id', 'creditor_id'], 'integer'],
            [['salary', 'gross_amount_earned'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payroll_item_id' => 'Payroll Item ID',
            'payroll_id' => 'Payroll ID',
            'creditor_id' => 'Creditor ID',
            'salary' => 'Salary',
            'gross_amount_earned' => 'Gross Amount Earned',
        ];
    }
}
