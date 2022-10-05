<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_ppmp".
 *
 * @property integer $ppmp_id
 * @property integer $division_id
 * @property integer $charged_to
 * @property integer $project_id
 * @property integer $year
 * @property integer $end_user_id
 * @property integer $head_id
 *
 * @property PpmpItem[] $ppmpItems
 */
class Ppmp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ppmp';
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
            [['division_id', 'charged_to', 'project_id', 'year', 'end_user_id', 'head_id'], 'required'],
            [['division_id', 'charged_to', 'project_id', 'year', 'end_user_id', 'head_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ppmp_id' => 'Ppmp ID',
            'division_id' => 'Division ID',
            'charged_to' => 'Charged To',
            'project_id' => 'Project ID',
            'year' => 'Year',
            'end_user_id' => 'End User ID',
            'head_id' => 'Head ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpmpItems()
    {
        return $this->hasMany(PpmpItem::className(), ['ppmp_id' => 'ppmp_id']);
    }
}
