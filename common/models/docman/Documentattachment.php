<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_document_attachment".
 *
 * @property integer $document_attachment_id
 * @property integer $document_id
 * @property string $filename
 * @property integer $document_type
 * @property string $last_update
 */
class Documentattachment extends \yii\db\ActiveRecord
{
    public $pdfFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_document_attachment';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_id', 'filename', 'document_type', 'last_update'], 'required'],
            [['document_id', 'document_type'], 'integer'],
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
            'document_attachment_id' => 'Document Attachment ID',
            'document_id' => 'Document ID',
            'filename' => 'Filename',
            'document_type' => 'Document Type',
            'last_update' => 'Last Update',
        ];
    }
    public function getDocument()  
    {  
      return $this->hasOne(Document::className(), ['document_id' => 'document_id']);  
    }
    
    public function getType()  
    {  
      return $this->hasOne(Documenttype::className(), ['document_type_id' => 'document_type']);  
    }
    
    public static function hasAttachment($id)
    {
        $model  = Documentattachment::findOne($id);
                
        //clearstatcache();
        if($model->filename != NULL){
            //$file = Yii::getAlias('@uploads') . '/docman/document/' . $model->document->document_id.'/'. $model->filename;
            $file = Yii::getAlias('@uploads') . '/docman/document/' . $model->document->document_code.'/'. $model->filename;
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
