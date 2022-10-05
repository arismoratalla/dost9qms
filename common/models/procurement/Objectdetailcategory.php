<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_object_category".
 *
 * @property integer $object_category_id
 * @property string $name
 *
 * @property ObjectDetail[] $objectDetails
 */
class Objectdetailcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_object_detail_category';
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
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'object_detail_category_id' => 'Object Category ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectDetails()
    {
        return $this->hasMany(ObjectDetail::className(), ['object_detail_category_id' => 'object_detail_category_id']);
    }
}
