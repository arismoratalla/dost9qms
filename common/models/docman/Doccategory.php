<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_doccategory".
 *
 * @property integer $doccategory_id
 * @property string $name
 * @property integer $qms_id
 * @property string $folder
 */
class Doccategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_doccategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'qms_id', 'folder'], 'required'],
            [['qms_id'], 'integer'],
            [['name', 'folder'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doccategory_id' => 'Doccategory ID',
            'name' => 'Name',
            'qms_id' => 'Qms ID',
            'folder' => 'Folder',
        ];
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getSections() 
    { 
        return $this->hasMany(Section::className(), ['doccategory_id' => 'doccategory_id']); 
    }
}
