<?php

namespace common\models\procurementplan;

use Yii;

/**
 * This is the model class for table "tbl_ppmp_item_sched".
 *
 * @property integer $ppmp_item_sched_id
 * @property integer $ppmp_item_id
 * @property integer $quantity
 * @property integer $month
 *
 * @property PpmpItem $ppmpItem
 */
class Ppmpitemsched extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ppmp_item_sched';
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
            [['ppmp_item_id', 'quantity', 'month'], 'required'],
            [['ppmp_item_id', 'quantity', 'month'], 'integer'],
            [['ppmp_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => PpmpItem::className(), 'targetAttribute' => ['ppmp_item_id' => 'ppmp_item_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ppmp_item_sched_id' => 'Ppmp Item Sched ID',
            'ppmp_item_id' => 'Ppmp Item ID',
            'quantity' => 'Quantity',
            'month' => 'Month',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpmpItem()
    {
        return $this->hasOne(PpmpItem::className(), ['ppmp_item_id' => 'ppmp_item_id']);
    }
}
