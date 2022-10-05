<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_request_attachment_signed".
 *
 * @property integer $request_attachment_signed_id
 * @property integer $request_attachment_id
 * @property string $filename
 * @property integer $status_id
 * @property string $last_update
 */
class Requestattachmentsigned extends \yii\db\ActiveRecord
{
    public $pdfFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request_attachment_signed';
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
            [['request_attachment_id', 'last_update'], 'required'],
            [['request_attachment_id', 'status_id'], 'integer'],
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
            'request_attachment_signed_id' => 'Request Attachment Signed ID',
            'request_attachment_id' => 'Request Attachment ID',
            'filename' => 'Filename',
            'status_id' => 'Status ID',
            'last_update' => 'Last Update',
        ];
    }
    
    public function getRequestattachment()  
    {  
      return $this->hasOne(Requestattachment::className(), ['request_attachment_id' => 'request_attachment_id']);  
    }
}
