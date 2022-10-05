<?php

namespace common\models\finance;

use Yii;

use common\models\procurement\Expenditureclass;
use common\models\procurement\Expenditureobject;

use common\models\procurement\Expenditureobjecttype;
use common\models\procurement\Expenditureobjectsubtype;
/**
 * This is the model class for table "tbl_os_allotment".
 *
 * @property integer $os_allotment_id
 * @property integer $osdv_id
 * @property integer $expenditure_class_id
 * @property integer $expenditure_object_id
 * @property double $amount
 */
class Osallotment extends \yii\db\ActiveRecord
{
    public $uacs_code;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_os_allotment';
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
            [['osdv_id', 'expenditure_class_id', 'expenditure_object_id', 'amount'], 'required'],
            [['osdv_id', 'expenditure_class_id', 'expenditure_object_id', 'object_type_id', 'object_sub_type_id'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'os_allotment_id' => 'Os Allotment ID',
            'osdv_id' => 'Osdv ID',
            'expenditure_class_id' => 'Expenditure Class ID',
            'expenditure_object_id' => 'Expenditure Object ID',
            'object_type_id' => 'Expenditure Object Type ID',
            'object_sub_type_id' => 'Expenditure Object SubType ID',
            'name' => 'Name',
            'amount' => 'Amount',
            'active' => 'Active',
        ];
    }
    
    public function getExpenditureclass()  
    {  
      return $this->hasOne(Expenditureclass::className(), ['expenditure_class_id' => 'expenditure_class_id']);  
    }
    
    public function getExpenditureobject()  
    {  
      return $this->hasOne(Expenditureobject::className(), ['expenditure_object_id' => 'expenditure_object_id']);  
    }
    
    public function getExpenditureobjecttype()  
    {  
      return $this->hasOne(Expenditureobjecttype::className(), ['expenditure_object_type_id' => 'object_type_id']);  
    }
    
    public function getExpenditureobjectsubtype()  
    {  
      return $this->hasOne(Expenditureobjectsubtype::className(), ['expenditure_object_sub_type_id' => 'object_sub_type_id']);  
    }
}
