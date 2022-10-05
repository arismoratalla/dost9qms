<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_type".
 *
 * @property integer $type_id
 * @property string $name
 *
 * @property SubType[] $subTypes
 */
class Obligationtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('procurementdb');
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
            'type_id' => 'Type ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubTypes()
    {
        return $this->hasMany(SubType::className(), ['type_id' => 'type_id']);
    }
    
    public function getFundcategory()  
    {  
      return $this->hasOne(Fundcategory::className(), ['fund_category_id' => 'fund_category_id']);  
    }
}
