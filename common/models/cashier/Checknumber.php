<?php

namespace common\models\cashier;

use Yii;

/**
 * This is the model class for table "tbl_check_number".
 *
 * @property integer $check_number_id
 * @property integer $type_id
 * @property integer $prefix
 * @property integer $year
 * @property integer $month
 * @property integer $counter
 */
class Checknumber extends \yii\db\ActiveRecord
{
    const PREP = 99;   
    const TYPE_ADA = 1;   
    const TYPE_CHECK = 2; 
    
    public $check_number;
    public $selected_keys;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_check_number';
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
            [['type_id', 'prefix', 'year', 'month', 'counter'], 'required'],
            [['type_id', 'prefix', 'year', 'month', 'counter'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'check_number_id' => 'Check Number ID',
            'type_id' => 'Type ID',
            'prefix' => 'Prefix',
            'year' => 'Year',
            'month' => 'Month',
            'counter' => 'Count',
        ];
    }
    
    static function getCheckNumber($typeId, $year, $month)
    {
        //$check = Checknumber::find()->where(['type_id' => $typeId, 'year' => $year, 'month' => $month])->orderBy(['check_number_id' => SORT_DESC])->one();
        $check = Checknumber::find()->where(['type_id' => $typeId])->orderBy(['check_number_id' => SORT_DESC])->one();
        if($check)
            $counter = (int)$check->counter + 1;
        else
            $counter = 1;
        
        return $counter;
        //return self::PREP.$year.$month.str_pad($counter, 3, '0', STR_PAD_LEFT);
        //return .str_pad($counter, 3, '0', STR_PAD_LEFT);
    }
}
