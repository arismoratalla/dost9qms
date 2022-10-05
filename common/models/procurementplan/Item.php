<?php

namespace common\models\procurementplan;
use common\models\procurementplan\Unitofmeasure;
use common\models\procurement\UnitType;
use Yii;

/**
 * This is the model class for table "tbl_item".
 *
 * @property integer $item_id
 * @property integer $item_category_id
 * @property integer $item_code
 * @property string $item_name
 * @property integer $unit_of_measure_id
 * @property double $price_catalogue
 * @property string $last_update
 */
class Item extends \yii\db\ActiveRecord
{
    const CSE = 1;
    const NON_CSE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_category_id', 'item_name', 'unit_of_measure_id', 'price_catalogue','supply_type'], 'required'],
            [['item_category_id', 'unit_of_measure_id', 'availability'], 'integer'],
            [['price_catalogue'], 'number'],
            [['last_update'], 'safe'],
            [['item_name'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'item_category_id' => 'Item Category ID',
            'supply_type' => 'Supply Type',
            'product_code' => 'Product Code',
            'item_name' => 'Item Name',
            'unit_of_measure_id' => 'Unit Of Measure ID',
            'price_catalogue' => 'Price Catalogue',
            'last_update' => 'Last Update',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemcategory()
    {
        return $this->hasOne(Itemcategory::className(), ['item_category_id' => 'item_category_id']);
    }
    
    public function getUnit()
    {
        $unit = Unitofmeasure::findOne($this->unit_of_measure_id);
        if($unit)
            return $unit->name;
        else
            return 'unit';
    }
    public function getUnittype()
    {
        $unit = UnitType::findOne($this->unit_of_measure_id);
        if($unit)
            return $unit->name_short;
        else
            return 'unit';
    }
    public function getSupplytype()
    {
        switch ($this->supply_type) {
            case self::CSE:
                return '<span class="label label-primary">CSE</span>';
                break;
            case self::NON_CSE:
                return '<span class="label label-warning">NON_CSE</span>';
                break;
        }
    }
}
