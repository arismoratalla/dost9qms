<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_registry_source".
 *
 * @property integer $source_id
 * @property string $name
 * @property string $code
 */
class Registrysource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_registry_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'source_id' => 'Source ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }
}
