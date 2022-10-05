<?php

namespace common\models\procurementplan;

use Yii;

/**
 * This is the model class for table "tbl_budget_allocation".
 *
 * @property integer $budget_allocation_id
 * @property integer $section_id
 * @property integer $year
 * @property double $amount
 */
class Budgetallocation_ extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_budget_allocation';
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
            [['budget_allocation_id', 'section_id', 'year', 'amount'], 'required'],
            [['budget_allocation_id', 'section_id', 'year'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'budget_allocation_id' => 'Budget Allocation ID',
            'section_id' => 'Section ID',
            'year' => 'Year',
            'amount' => 'Amount',
        ];
    }
}
