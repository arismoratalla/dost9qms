<?php

namespace common\models\employeecompensation;

use Yii;

/**
 * This is the model class for table "tbl_compensation".
 *
 * @property integer $compensation_id
 * @property integer $creditor_id
 * @property string $salary
 * @property string $gross_amount_earned
 * @property integer $obligation_type_id
 */
class Compensation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_compensation';
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
            [['creditor_id', 'salary', 'gross_amount_earned', 'obligation_type_id'], 'required'],
            [['creditor_id', 'obligation_type_id'], 'integer'],
            [['salary', 'gross_amount_earned'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'compensation_id' => 'Compensation ID',
            'creditor_id' => 'Creditor ID',
            'salary' => 'Salary',
            'gross_amount_earned' => 'Gross Amount Earned',
            'obligation_type_id' => 'Obligation Type ID',
        ];
    }
}
