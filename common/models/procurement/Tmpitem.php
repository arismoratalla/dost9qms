<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tmp_ppmp_item".
 *
 * @property integer $ppmp_id
 * @property integer $division_id
 * @property integer $unit_id
 * @property integer $project_id
 * @property integer $year
 * @property integer $item_id
 * @property string $description
 * @property integer $unit
 * @property string $unit_description
 * @property double $cost
 * @property integer $checked
 * @property integer $approved_qty
 * @property integer $supplemental
 * @property integer $status_id
 */
class Tmpitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tmppritems';
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
            //[['ppmp_id', 'division_id', 'unit_id', 'project_id', 'year', 'item_id', 'description', 'unit', 'unit_description', 'cost', 'checked', 'approved_qty'], 'required'],
            [['ppmp_id', 'division_id', 'unit_id', 'project_id', 'year', 'item_id', 'description', 'unit', 'unit_description', 'cost', 'checked', 'approved_qty'], 'safe'],
            [['ppmp_id', 'division_id', 'unit_id', 'project_id', 'year', 'item_id', 'unit', 'checked', 'approved_qty', 'supplemental', 'status_id'], 'integer'],
            [['description'], 'string'],
            [['cost'], 'number'],
            [['unit_description'], 'string', 'max' => 20],
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
            'unit_id' => 'Unit ID',
            'project_id' => 'Project ID',
            'year' => 'Year',
            'item_id' => 'Item ID',
            'description' => 'Description',
            'unit' => 'Unit',
            'unit_description' => 'Unit',
            'cost' => 'Cost',
            'checked' => 'Checked',
            'approved_qty' => 'Approved Qty',
            'supplemental' => 'Supplemental',
            'status_id' => 'Status ID',
        ];
    }
}
