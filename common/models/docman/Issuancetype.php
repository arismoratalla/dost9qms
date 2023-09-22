<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_issuance_type".
 *
 * @property integer $issuance_type_id
 * @property string $name
 * @property string $code
 * @property integer $active
 */
class Issuancetype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_issuance_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 25],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'issuance_type_id' => 'Issuance Type ID',
            'name' => 'Name',
            'code' => 'Code',
            'active' => 'Active',
        ];
    }
}
