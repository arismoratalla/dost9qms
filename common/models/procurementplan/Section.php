<?php

namespace common\models\procurementplan;

use Yii;

use common\models\procurementplan\Budgetallocation;
use common\models\procurementplan\Ppmp;
use common\models\procurement\Division;
/**
 * This is the model class for table "tbl_section".
 *
 * @property integer $section_id
 * @property integer $division_id
 * @property string $code
 * @property string $name
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $selectyear;
    
    public static function tableName()
    {
        return 'tbl_section';
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
            [['division_id', 'code', 'name'], 'required'],
            [['division_id'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section_id' => 'Section ID',
            'division_id' => 'Division ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['division_id' => 'division_id']);
    }
    
//    public function getPp()
//    {
//        return $this->hasOne(Ppmp::className(), ['section_id' => 'unit_id']);
//    }
    
    /*public function getPpmpYear($section_id, $year)
    {
        $ppmp = Ppmp::find()
            ->where(['unit_id' => $section_id, 'year' => $year])
            ->one();
        if($ppmp)
            return $ppmp->year;
        else
            return false;
    }*/
    
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpmp()
    {
        return $this->hasMany(Ppmp::className(), ['section_id' => 'unit_id']);
    }
    
    
}
