<?php

namespace common\models\procurementplan;

use Yii;

/**
 * This is the model class for table "tbl_item_price".
 *
 * @property integer $item_price_id
 * @property integer $item_id
 * @property double $price_catalogue
 * @property string $date
 *
 * @property Item $item
 */
class Itemprice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_item_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['item_price_id'], 'required'],
            [['item_price_id', 'item_id'], 'integer'],
            [['price_catalogue'], 'number'],
            [['date'], 'safe'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'item_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_price_id' => 'Item Price ID',
            'item_id' => 'Item ID',
            'price_catalogue' => 'Price Catalogue',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['item_id' => 'item_id']);
    }
}
