<?php

namespace common\models\employeecompensation;

use Yii;

/**
 * This is the model class for table "tbl_deduction".
 *
 * @property integer $deduction_id
 * @property string $medicare
 * @property string $pagibig_i
 * @property string $pagibig_ii
 * @property string $hdmf_housing_loan
 * @property string $pagibig_loan
 * @property string $gsis_life
 * @property string $policy_loan
 * @property string $gsis_emergecy_loan
 * @property string $gsis_conso_loan
 * @property string $sikat_mdabp
 * @property string $sss_contribution
 * @property string $payroll_date
 * @property integer $payroll_item_id
 */
class Deduction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_deduction';
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
            [['medicare', 'pagibig_i', 'pagibig_ii', 'hdmf_housing_loan', 'pagibig_loan', 'gsis_life', 'policy_loan', 'gsis_emergecy_loan', 'gsis_conso_loan', 'sikat_mdabp', 'sss_contribution', 'payroll_date', 'payroll_item_id'], 'required'],
            [['medicare', 'pagibig_i', 'pagibig_ii', 'hdmf_housing_loan', 'pagibig_loan', 'gsis_life', 'policy_loan', 'gsis_emergecy_loan', 'gsis_conso_loan', 'sikat_mdabp', 'sss_contribution'], 'number'],
            [['payroll_date'], 'safe'],
            [['payroll_item_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deduction_id' => 'Deduction ID',
            'medicare' => 'Medicare',
            'pagibig_i' => 'Pagibig I',
            'pagibig_ii' => 'Pagibig Ii',
            'hdmf_housing_loan' => 'Hdmf Housing Loan',
            'pagibig_loan' => 'Pagibig Loan',
            'gsis_life' => 'Gsis Life',
            'policy_loan' => 'Policy Loan',
            'gsis_emergecy_loan' => 'Gsis Emergecy Loan',
            'gsis_conso_loan' => 'Gsis Conso Loan',
            'sikat_mdabp' => 'Sikat Mdabp',
            'sss_contribution' => 'Sss Contribution',
            'payroll_date' => 'Payroll Date',
            'payroll_item_id' => 'Payroll Item ID',
        ];
    }
}
