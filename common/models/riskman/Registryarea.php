<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_registry_area".
 *
 * @property integer $area_id
 * @property string $name
 */
class Registryarea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_registry_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area_id' => 'Area ID',
            'name' => 'Name',
        ];
    }
}
