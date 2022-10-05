<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_tax_category".
 *
 * @property integer $tax_category_id
 * @property string $name
 * @property string $rate1
 * @property string $rate2
 * @property integer $active
 */
class Taxcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tax_category';
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
            [['name', 'rate1', 'rate2'], 'required'],
            [['rate1', 'rate2'], 'number'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tax_category_id' => 'Tax Category ID',
            'name' => 'Name',
            'rate1' => 'Rate1',
            'rate2' => 'Rate2',
            'active' => 'Active',
        ];
    }
}
