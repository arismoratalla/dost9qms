<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_ppmp_item".
 *
 * @property integer $ppmp_item_id
 * @property integer $ppmp_id
 * @property string $code
 * @property string $description
 * @property integer $quantity
 * @property integer $unit
 * @property double $estimated_budget
 * @property integer $mode_of_procurement
 *
 * @property Ppmp $ppmp
 * @property PpmpItemSched[] $ppmpItemScheds
 */
class PpmpItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ppmp_item';
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
            [['ppmp_id', 'code', 'description', 'quantity', 'unit', 'estimated_budget', 'mode_of_procurement'], 'required'],
            [['ppmp_id', 'quantity', 'unit', 'mode_of_procurement'], 'integer'],
            [['description'], 'string'],
            [['estimated_budget'], 'number'],
            [['code'], 'string', 'max' => 20],
            [['ppmp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ppmp::className(), 'targetAttribute' => ['ppmp_id' => 'ppmp_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ppmp_item_id' => 'Ppmp Item ID',
            'ppmp_id' => 'Ppmp ID',
            'code' => 'Code',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'unit' => 'Unit',
            'estimated_budget' => 'Estimated Budget',
            'mode_of_procurement' => 'Mode Of Procurement',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpmp()
    {
        return $this->hasOne(Ppmp::className(), ['ppmp_id' => 'ppmp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpmpItemScheds()
    {
        return $this->hasMany(PpmpItemSched::className(), ['ppmp_item_id' => 'ppmp_item_id']);
    }
}
