<?php

namespace common\models\procurementplan;

use Yii;

/**
 * This is the model class for table "tbl_unitofmeasure".
 *
 * @property integer $unit_of_measure_id
 * @property string $name
 * @property integer $status
 */
class Unitofmeasure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_unitofmeasure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'unit_of_measure_id' => 'Unit Of Measure ID',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }
}
