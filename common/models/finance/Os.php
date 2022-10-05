<?php

namespace common\models\finance;

use Yii;
use common\models\procurement\Expenditureclass;
/**
 * This is the model class for table "tbl_os".
 *
 * @property integer $os_id
 * @property integer $osdv_id
 * @property integer $request_id
 * @property string $os_number
 * @property string $os_date
 */
class Os extends \yii\db\ActiveRecord
{
    public $classId;
    public $_os_number;
    public $_osdv_id;
    public $_request_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_os';
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
            [['osdv_id', 'request_id', 'os_number', 'os_date'], 'required'],
            [['osdv_id', 'request_id'], 'integer'],
            [['os_date', '_os_number', '_osdv_id', '_request_id'], 'safe'],
            [['os_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'os_id' => 'Os ID',
            'osdv_id' => 'Osdv ID',
            'request_id' => 'Request ID',
            'os_number' => 'Os Number',
            'os_date' => 'Os Date',
            'numberOfOs' => 'Enter Number of Obligations to SKIP',
        ];
    }
    
    static function generateOsNumber($expenditureClassId, $createDate)
    {
        //OS-200-20-02-1516
        $year = date("y", strtotime($createDate));
        $month = date("m", strtotime($createDate));
        
        $os_type = Expenditureclass::findOne($expenditureClassId);
        $os_type = $os_type->account_code;
        
        $os = Os::find()->where(['year(os_date)' => date("Y", strtotime($createDate))])->orderBy(['os_id' => SORT_DESC])->one();
        if($os){
            $data = explode('-',$os->os_number);
            $count = (int)$data[4] + 1;
        }else{
            $count = 1;
        }
        
        return 'OS-'.$os_type.'-'.$year.'-'.$month.'-'.str_pad($count, 4, '0', STR_PAD_LEFT);
    }
    
    static function getLastOS()
    {
        //OS-200-20-02-1516
        $year = date("y");
        $month = date("m");
        
        $os_type = Expenditureclass::findOne(1);
        $os_type = $os_type->account_code;
        
        $os = Os::find()->orderBy(['os_id' => SORT_DESC])->one();
        if($os){
            $data = explode('-',$os->os_number);
            $count = (int)$data[4] + 1;
        }else{
            $count = 1;
        }
        
        return 'OS-'.$os_type.'-'.$year.'-'.$month.'-'.str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
