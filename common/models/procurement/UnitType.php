<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_unit_type".
 *
 * @property integer $unit_type_id
 * @property string $name_short
 * @property string $name_long
 */
class UnitType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_unit_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_short', 'name_long'], 'required'],
            [['name_short'], 'string', 'max' => 10],
            [['name_long'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'unit_type_id' => 'Unit Type ID',
            'name_short' => 'Name Short',
            'name_long' => 'Name Long',
        ];
    }
}
