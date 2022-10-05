<?php

namespace common\models\procurementplan;

use common\models\budget\Budgetallocation;
use common\models\procurementplan\Ppmpitem;

use common\models\procurement\Division;
//use common\models\procurement\Unit;
use common\models\procurement\Project;
use common\models\procurement\Section;

use common\models\system\Usersection;

use Yii;

/**
 * This is the model class for table "tbl_ppmp".
 *
 * @property integer $ppmp_id
 * @property integer $division_id
 * @property integer $unit_id
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
    const STATUS_PENDING = 1;
    const STATUS_SUBMITTED = 2;
    const STATUS_APPROVED = 3;
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
            [['division_id', 'unit_id', 'charged_to', 'project_id', 'year', 'end_user_id', 'head_id', 'status_id'], 'required'],
            [['division_id', 'unit_id', 'charged_to', 'project_id', 'year', 'end_user_id', 'head_id', 'status_id'], 'integer'],
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
            'charged_to' => 'Charged To',
            'project_id' => 'Project ID',
            'year' => 'Year',
            'end_user_id' => 'End User ID',
            'head_id' => 'Head ID',
            'status_id' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpmpItems()
    {
        return $this->hasMany(PpmpItem::className(), ['ppmp_id' => 'ppmp_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getSection()
    {
        return $this->hasOne(Section::className(), ['section_id' => 'section_id']);
    }*/
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['division_id' => 'division_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Section::className(), ['section_id' => 'unit_id']);
    }
    
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_id']);
    }
    /*public function getBudgetAllocation()
    {
        //$allocation = Budgetallocation::find()->where(['section_id' => $this->unit_id, 'year' => $this->year])->one();
        //if($allocation)
        //    return $allocation->amount;
        //else
        //    return 0;
        $this->unit->budgetallocation->getTotal();
        //return $model->budgetallocation ? $model->budgetallocation->getTotal() : '';
    }*/
    
    public function getRunningTotal()
    {
        $items = Ppmpitem::find()->where(['ppmp_id' => $this->ppmp_id, 'active' => 1, 'supplemental' => 0])->all();
        $supplementalitems = Ppmpitem::find()->where(['ppmp_id' => $this->ppmp_id, 'supplemental' => 1, 'active' => 1, 'status_id' => 2])->all();
        $runningtotal = 0;
        $supplementaltotal = 0;
        foreach($items as $item)
        {
            $runningtotal += $item->getTotalamount();
        }
        foreach($supplementalitems as $supplementalitem)
        {
            $supplementaltotal += $supplementalitem->getTotalamount();
        }
        return $runningtotal + $supplementaltotal;
    }
    
    public function isPending()
    {
        return ($this->status_id == self::STATUS_PENDING) ? true : false;
    }
    
    public function getStatus()
    {
        switch ($this->status_id) {
            case self::STATUS_PENDING:
                return 'PENDING';
                break;
            case self::STATUS_SUBMITTED:
                return 'SUBMITTED';
                break;
            case self::STATUS_APPROVED:
                return 'APPROVED';
                break;
            default:
                return 'PENDING';
        }
    }
    
    public function isMember()
    {
        if($this->project_id)
            $user = Usersection::find()->where(['user_id' => Yii::$app->user->id, 'project_id' => $this->project_id])->one();
        else
            $user = Usersection::find()->where(['user_id' => Yii::$app->user->id, 'section_id' => $this->unit_id])->one();
        
        if($user)
            return true;
        else
            return false;
    }
}
