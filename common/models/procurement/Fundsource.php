<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_fund_source".
 *
 * @property integer $fund_source_id
 * @property string $code
 * @property string $name
 * @property integer $active
 */
class Fundsource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_fund_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'active'], 'required'],
            [['name'], 'string'],
            [['active'], 'integer'],
            [['code'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fund_source_id' => 'Fund Source ID',
            'code' => 'Code',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
}
