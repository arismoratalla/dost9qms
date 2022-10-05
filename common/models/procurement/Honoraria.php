<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_honoraria".
 *
 * @property integer $honoraria_id
 * @property string $code
 * @property string $name
 */
class Honoraria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_honoraria';
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
            'honoraria_id' => 'Honoraria ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }
}
