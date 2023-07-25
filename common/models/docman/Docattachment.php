<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_doc_attachment".
 *
 * @property integer $doc_attachment_id
 * @property integer $doc_id
 * @property string $filename
 * @property integer $doc_type_id
 * @property integer $status_id
 * @property string $last_update
 */
class Docattachment extends \yii\db\ActiveRecord
{
    const STATUS_ARCHIVED = 0;
    const STATUS_ACTIVE = 10;

    public $pdfFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_doc_attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_id', 'doc_type_id', 'status_id', 'last_update'], 'required'],
            [['doc_id', 'doc_type_id', 'status_id'], 'integer'],
            [['last_update'], 'safe'],
            [['filename'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doc_attachment_id' => 'Doc Attachment ID',
            'doc_id' => 'Doc ID',
            'filename' => 'Filename',
            'doc_type_id' => 'Doc Type ID',
            'status_id' => 'Status ID',
            'last_update' => 'Last Update',
        ];
    }

    /**  
     * @return \yii\db\ActiveQuery  
     */  
    public function getDocument()  
    {  
        return $this->hasOne(Doc::className(), ['doc_id' => 'doc_id']);  
    }

    public function getType()  
    {  
      return $this->hasOne(Documenttype::className(), ['document_type_id' => 'doc_type_id']);  
    }
    
    public static function hasAttachment($id)
    {
        $model  = Docattachment::findOne($id);
                
        //clearstatcache();
        if($model->filename != NULL){
            $file = Yii::getAlias('@uploads') . '/docman/9001/' . $model->document->section->doccategory->folder . '/' . $model->document->section->section_id . '/' . $model->filename;
        }else{
            $file = false;
        }

        if(file_exists($file)) {
            return 1;
        } else {
            return 0;
        }
    }
}
