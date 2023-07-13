<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_doccategory".
 *
 * @property integer $doccategory_id
 * @property string $name
 * @property integer $qms_id
 */
class Doccategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_doccategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'qms_id'], 'required'],
            [['qms_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doccategory_id' => 'Doccategory ID',
            'name' => 'Name',
            'qms_id' => 'Qms ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategories()
    {
        return $this->hasMany(Subcategory::className(), ['doccategory_id' => 'doccategory_id']);
    }
}
