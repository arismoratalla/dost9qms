<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_position".
 *
 * @property integer $position_id
 * @property string $code
 * @property string $name
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => 'Position ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }
}
