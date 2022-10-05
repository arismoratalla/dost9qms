<?php

namespace common\models\procurementplan;

use Yii;

/**
 * This is the model class for table "tbl_remaining_supplemental_item".
 *
 * @property integer $remaining_ppmp_item_id
 * @property integer $ppmp_item_id
 * @property integer $q1
 * @property integer $q2
 * @property integer $q3
 * @property integer $q4
 * @property integer $q5
 * @property integer $q6
 * @property integer $q7
 * @property integer $q8
 * @property integer $q9
 * @property integer $q10
 * @property integer $q11
 * @property integer $q12
 *
 * @property PpmpItem $ppmpItem
 */
class RemainingSupplementalItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_remaining_supplemental_item';
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
            [['ppmp_item_id', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12'], 'integer'],
            [['ppmp_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => PpmpItem::className(), 'targetAttribute' => ['ppmp_item_id' => 'ppmp_item_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'remaining_ppmp_item_id' => 'Remaining Ppmp Item ID',
            'ppmp_item_id' => 'Ppmp Item ID',
            'q1' => 'Q1',
            'q2' => 'Q2',
            'q3' => 'Q3',
            'q4' => 'Q4',
            'q5' => 'Q5',
            'q6' => 'Q6',
            'q7' => 'Q7',
            'q8' => 'Q8',
            'q9' => 'Q9',
            'q10' => 'Q10',
            'q11' => 'Q11',
            'q12' => 'Q12',
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
