<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_section".
 *
 * @property integer $section_id
 * @property integer $doccategory_id
 * @property string $name
 * @property integer $active
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doccategory_id', 'name'], 'required'],
            [['doccategory_id', 'active'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section_id' => 'Section ID',
            'doccategory_id' => 'Doccategory ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getDoccategory() 
    { 
        return $this->hasOne(Doccategory::className(), ['doccategory_id' => 'doccategory_id']); 
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getDocs() 
    { 
        return $this->hasMany(Doc::className(), ['section_id' => 'section_id']); 
    }
}
