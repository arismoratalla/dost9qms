<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_document".
 *
 * @property integer $document_id
 * @property string $subject
 * @property string $filename
 * @property string $document_code
 * @property integer $category_id
 * @property integer $functional_unit_id
 * @property string $content
 * @property integer $revision_number
 * @property string $effectivity_date
 * @property integer $user_id
 * @property integer $active
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_document';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->db;
    }

    const SCENARIO_LOGIN = 'all_units';
    const SCENARIO_REGISTER = 'exclusive';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qms_type_id', 'subject', 'document_code', 'category_id', 'content', 'revision_number', 'effectivity_date'], 'required'],
            [['category_id', 'functional_unit_id', 'revision_number', 'user_id', 'active'], 'integer'],
            [['content'], 'string'],
            [['effectivity_date'], 'safe'],
            [['subject'], 'string', 'max' => 200],
            [['filename'], 'string', 'max' => 100],
            [['document_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'document_id' => 'Document ID',
            'qms_type_id' => 'QMS Type',
            'subject' => 'Subject',
            'filename' => 'Filename',
            'document_code' => 'Document Code',
            'category_id' => 'Category ID',
            'functional_unit_id' => 'Functional Unit ID',
            'content' => 'Content',
            'revision_number' => 'Revision Number',
            'effectivity_date' => 'Effectivity Date',
            'user_id' => 'User ID',
            'active' => 'Active',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachments()
    {
        return $this->hasMany(Documentattachment::className(), ['document_id' => 'document_id'])->andOnCondition(['document_type' => 1]);
    }
    
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    public function getFunctionalunit()
    {
        return $this->hasOne(Functionalunit::className(), ['functional_unit_id' => 'functional_unit_id']);
    }
}
