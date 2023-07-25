<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_doc".
 *
 * @property integer $doc_id
 * @property integer $section_id
 * @property string $code
 * @property string $name
 * @property string $effectivity_date
 * @property integer $revision_num
 * @property string $person_responsible
 * @property string $copy_holder
 * @property integer $status_id
 */
class Doc extends \yii\db\ActiveRecord
{
    const STATUS_OBSOLETE = 0;
    const STATUS_ACTIVE = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_id', 'name'], 'required'],
            [['section_id', 'revision_num', 'status_id'], 'integer'],
            [['effectivity_date'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 200],
            [['person_responsible', 'copy_holder'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doc_id' => 'Doc ID',
            'section_id' => 'Section ID',
            'code' => 'Code',
            'name' => 'Name',
            'effectivity_date' => 'Effectivity Date',
            'revision_num' => 'Revision Num',
            'person_responsible' => 'Person Responsible',
            'copy_holder' => 'Copy Holder',
            'status_id' => 'Status ID',
        ];
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getSection() 
    { 
        return $this->hasOne(Section::className(), ['section_id' => 'section_id']); 
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getAttachments() 
    { 
        return $this->hasMany(Docattachment::className(), ['doc_id' => 'doc_id']); 
    }
}
