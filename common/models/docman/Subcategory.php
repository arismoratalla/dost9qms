<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_subcategory".
 *
 * @property integer $subcategory_id
 * @property integer $doccategory_id
 * @property string $name
 * @property integer $active
 */
class Subcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_subcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doccategory_id', 'name'], 'required'],
            [['doccategory_id', 'active'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subcategory_id' => 'Subcategory ID',
            'doccategory_id' => 'Doccategory ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }

    public function getDoccategory()
    {
        return $this->hasOne(Doccategory::className(), ['doccategory_id' => 'doccategory_id']);
    }
}
