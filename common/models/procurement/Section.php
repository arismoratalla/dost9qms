<?php

namespace common\models\procurement;

use Yii;

use common\models\budget\Budgetallocation;
use common\models\procurementplan\Ppmp;
use common\models\system\Usersection;

use yii\helpers\Html;
use yii\helpers\Url;
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
        return Yii::$app->get('db');
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
    
    public function getPpmpYear($section_id, $year)
    {
        $ppmp = Ppmp::find()
            ->where(['unit_id' => $section_id, 'year' => $year])
            ->one();
        if($ppmp)
            return $ppmp->ppmp_id;
        else
            return false;
    }
    
    public function getMembers()
    {
        $users = Usersection::find()
            ->where(['section_id' => $this->section_id])
            ->all();
        $output = '';
        if($users){
            $access = [
                '0' => 'btn-default',   
                '1' => 'btn-primary',   
                '2' => 'btn-success'   
            ];
            foreach($users as $user)
            {
                if(!$user->access)
                    $user->access = 0;
                $output .= '<button id="'.$user->user_section_id.'" type="button" class="'.$access[$user->access].' btn-sm">'.$user->profile->getFullname().'</button> ';
            }        
        }
        
        return $output;
    }
    
    public function getPpmpStatus($section_id, $year)
    {
        //$ppmp = Ppmp::findOne($ppmp_id);
        $ppmp = Ppmp::find()
            ->where(['unit_id' => $section_id, 'year' => $year])
            ->one();
        $status = [
                '0' => 'btn-default',   
                '1' => 'btn-warning',   
                '2' => 'btn-info',
                '3' => 'btn-success',
            ];
        
        if($ppmp){
            switch ($ppmp->status_id) {
                case 0:
                    return 'PENDING';
                    break;
                case Ppmp::STATUS_PENDING:
                    return 'PENDING';
                    break;
                case Ppmp::STATUS_SUBMITTED:
                    return 'SUBMITTED';
                    break;
                case Ppmp::STATUS_APPROVED:
                    return 'APPROVED';
                    break;
                default:
                    return 'PENDING';
            }
        }else{
            return 'PENDING';
        }
    }
            
    public function getPpmps()
    {
        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }else{
            $year = date('Y');
        }

        $ppmps = Ppmp::find()
            ->where(['unit_id' => $this->section_id, 'year' => $year])
            ->all();
        $status = [
                '0' => 'btn-default',   
                '1' => 'btn-warning',   
                '2' => 'btn-info',
                '3' => 'btn-success',
            ];
        
        $output = '';
        foreach($ppmps as $ppmp)
        {
            //Html::button('PENDING', ['title' => 'Approved', 'class' => 'btn btn-warning', 'style'=>'width: 90px; margin-right: 6px;'])
            $output .= Html::a('  '.$ppmp->year.'  ', '', ['onclick' => "window.open ('".Url::toRoute(['view', 'id' => $ppmp->ppmp_id])."'); return false", 'style'=>'width: 60px; font-weight: bold; margin-right: 6px;', 'class' => 'btn btn-md '.$status[$ppmp->status_id]]). ' ';
        }
        return $output;
    }
    
    public function getBudgetallocation()
    {
        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }else{
            $year = date('Y');
        }
        return $this->hasOne(Budgetallocation::className(), ['section_id' => 'section_id'])->where(['year' => $year]);
    }
    public function getUsersection(){
        return $this->hasMany(Usersection::className(), ['section_id' => 'section_id']);
    }
    
    /*public function getBudgetallocation()
    {
        $budget = Budgetallocation::find()
            ->where(['section_id' => $this->section_id])->one();
        
        if($budget)
        {
            $fmt = Yii::$app->formatter;
            return $budget ? Html::a($fmt->asDecimal($budget->getTotalbudget()), ['budgetallocation/view?id='.$budget->budget_allocation_id])  : '-';
        }
        
        
        //return $budget ? $fmt->asDecimal($budget->amount) : '-';
    }*/
}
