<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_program".
 *
 * @property integer $program_id
 * @property integer $fund_source_id
 * @property string $name
 * @property string $code
 * @property integer $active
 */
class Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['program_id', 'fund_source_id', 'name', 'code'], 'required'],
            [['program_id', 'fund_source_id', 'active'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'program_id' => 'Program ID',
            'fund_source_id' => 'Fund Source ID',
            'name' => 'Name',
            'code' => 'Code',
            'active' => 'Active',
        ];
    }
}
