<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_supplier".
 *
 * @property integer $supplier_id
 * @property string $supplier_name
 * @property string $supplier_address
 * @property string $supplier_contact
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_supplier';
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
            [['supplier_name'], 'string', 'max' => 100],
            [['supplier_address', 'supplier_contact'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => 'Supplier ID',
            'supplier_name' => 'Supplier Name',
            'supplier_address' => 'Supplier Address',
            'supplier_contact' => 'Supplier Contact',
        ];
    }


}
