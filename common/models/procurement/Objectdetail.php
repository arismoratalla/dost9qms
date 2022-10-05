<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_object_detail".
 *
 * @property integer $object_detail_id
 * @property integer $object_detail_category_id
 * @property string $name
 * @property string $details
 *
 * @property LineItemBudgetObjectDetails[] $lineItemBudgetObjectDetails
 * @property ObjectCategory $objectCategory
 */
class Objectdetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_object_detail';
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
            [['object_detail_category_id', 'name', 'details'], 'required'],
            [['object_detail_category_id'], 'integer'],
            [['details'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['object_detail_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectCategory::className(), 'targetAttribute' => ['object_detail_category_id' => 'object_detail_category_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'object_detail_id' => 'Object Detail ID',
            'object_detail_category_id' => 'Object Detail Category ID',
            'name' => 'Name',
            'details' => 'Details',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineItemBudgetObjectDetails()
    {
        return $this->hasMany(Lineitembudgetobjectdetails::className(), ['object_detail_id' => 'object_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectCategory()
    {
        return $this->hasOne(Objectcategory::className(), ['object_detail_category_id' => 'object_detail_category_id']);
    }
}
