<?php

namespace common\models\procurementplan;

use Yii;

/**
 * This is the model class for table "tbl_item_category".
 *
 * @property integer $item_category_id
 * @property string $category_name
 * @property integer $status
 */
class Itemcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_item_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['status'], 'integer'],
            [['category_name'], 'string', 'max' => 800],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_category_id' => 'Item Category ID',
            'category_name' => 'Category Name',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasMany(Item::className(), ['item_category_id' => 'item_category_id']);
    }
}
