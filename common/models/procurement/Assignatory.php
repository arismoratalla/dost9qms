<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_assignatory".
 *
 * @property integer $assignatory_id
 * @property string $CompanyTitle
 * @property string $RegionOffice
 * @property string $Address 
 * @property string $report_title
 * @property integer $assignatory_1
 * @property integer $assignatory_2
 * @property integer $assignatory_3
 * @property integer $assignatory_4
 * @property integer $assignatory_5
 * @property integer $assignatory_6
 */
class Assignatory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_assignatory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assignatory_1', 'assignatory_2', 'assignatory_3', 'assignatory_4', 'assignatory_5', 'assignatory_6'], 'integer'],
            [['report_title','CompanyTitle','RegionOffice','Address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'assignatory_id' => 'Assignatory ID',
            'CompanyTitle' => 'Company Title',
            'RegionOffice' => 'Region Office',
            'Address' => 'Address',
            'report_title' => 'Report Title',
            'assignatory_1' => 'Assignatory 1',
            'assignatory_2' => 'Assignatory 2',
            'assignatory_3' => 'Assignatory 3',
            'assignatory_4' => 'Assignatory 4',
            'assignatory_5' => 'Assignatory 5',
            'assignatory_6' => 'Assignatory 6',
        ];
    }

    public function getAssig1() {
        return $this->hasOne(Profile::className(), ['user_id'=>'assignatory_1']);
    }
    public function getAssig2() {
        return $this->hasOne(Profile::className(), ['user_id'=>'assignatory_2']);
    }
    public function getAssig3() {
        return $this->hasOne(Profile::className(), ['user_id'=>'assignatory_3']);
    }
    public function getAssig4() {
        return $this->hasOne(Profile::className(), ['user_id'=>'assignatory_4']);
    }
    public function getAssig5() {
        return $this->hasOne(Profile::className(), ['user_id'=>'assignatory_5']);
    }
    public function getAssig6() {
        return $this->hasOne(Profile::className(), ['user_id'=>'assignatory_6']);
    }


}
