<?php

namespace common\models\cashier;

use Yii;

/**
 * This is the model class for table "tbl_creditor".
 *
 * @property integer $creditor_id
 * @property integer $creditor_type_id
 * @property string $name
 * @property string $bank_name
 * @property string $account_number
 *
 * @property LddapadaItem[] $lddapadaItems
 */
class Creditor extends \yii\db\ActiveRecord
{
    public $request_type_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_creditor';
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
            [['creditor_type_id', 'name', 'bank_name'], 'required'],
            [['creditor_type_id'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['bank_name', 'account_number', 'tin_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'creditor_id' => 'Creditor ID',
            'creditor_type_id' => 'Creditor Type ID',
            'name' => 'Name',
            'bank_name' => 'Bank Name',
            'account_number' => 'Account Number',
            'tin_number' => 'TIN Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLddapadaItems()
    {
        return $this->hasMany(LddapadaItem::className(), ['creditor_id' => 'creditor_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Creditortype::className(), ['creditor_type_id' => 'creditor_type_id']);
    }
}
