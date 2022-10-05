<?php

namespace common\models\procurement;

use common\models\budget\Budgetallocation;
use common\models\procurementplan\Ppmp;
use common\models\system\Usersection;

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "tbl_project".
 *
 * @property integer $project_id
 * @property string $code
 * @property string $name
 * @property string $description
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'description'], 'required'],
            [['description'], 'string'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }
    
    public function getPpmps()
    {
        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }else{
            $year = date('Y');
        }
        $ppmps = Ppmp::find()
            ->where(['project_id' => $this->project_id, 'year' => $year])
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
        return $this->hasOne(Budgetallocation::className(), ['project_id' => 'project_id'])->where(['year' => $year]);
    }
    public function getUsersection(){
        return $this->hasMany(Usersection::className(), ['project_id' => 'project_id']);
    }
}
