<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_request_attachment".
 *
 * @property integer $request_attachment_id
 * @property integer $request_id
 * @property string $name
 * @property integer $attachment_id
 */
class Requestattachment extends \yii\db\ActiveRecord
{
    public $pdfFile;
    
    const STATUS_ON_HAND = 10; 
    const STATUS_TURNED_OVER = 20;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request_attachment';
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
            [['request_id', 'attachment_id'], 'required'],
            [['request_id', 'status_id', 'attachment_id'], 'integer'],
            [['pdfFile'], 'file'],
            [['filename'], 'safe'],
            [['filename'], 'string', 'max' => 100],
            //[['filename'], 'file', 'extensions'=>'pdf', 'skipOnEmpty' => true] //
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_attachment_id' => 'Request Attachment ID',
            'request_id' => 'Request ID',
            'filename' => 'Filename',
            'status_id' => 'Status',
            'attachment_id' => 'Attachment ID',
        ];
    }
    
    public function getAttachment()  
    {  
      return $this->hasOne(Attachment::className(), ['attachment_id' => 'attachment_id']);  
    } 
    
    public function getSignedattachment()  
    {  
      return $this->hasOne(Requestattachmentsigned::className(), ['request_attachment_id' => 'request_attachment_id'])->orderBy(['request_attachment_signed_id' => SORT_DESC]);
      //$model  = Requestattachment::find($id)->orderBy(['request_attachment_signed_id' => SORT_DESC])->one();
    } 
    
    public function getRequest()  
    {  
      return $this->hasOne(Request::className(), ['request_id' => 'request_id']);  
    }
    
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['request_attachment_id' => 'record_id']);
    }
    
    public static function hasAttachment($id)
    {
        $model  = Requestattachment::findOne($id);
                
        //$file = 'uploads/finance/request/' . $model->request->request_number.'/'. $model->filename;
        //clearstatcache();
        if($model->filename != NULL){
            //$file = 'uploads/finance/request/' . $model->request->request_number.'/'. $model->filename;
            $file = Yii::getAlias('@uploads') . '/finance/request/' . $model->request->request_number.'/'. $model->filename;
        }else{
            $file = false;
        }

        if(file_exists($file)) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public static function hasSignedattachment($id){
        $signed = Requestattachmentsigned::find()->where(['request_attachment_id' => $id])->count();
        if($signed)
            return true;
        else
            return false;
    }
    
    public static function generateCode($id)
    {
        $model  = Requestattachment::findOne($id);
        $code = Yii::$app->user->id;
        for($i=0;$i<5;$i++){
            $code .= Requestattachment::randomChars(2);
        }
        return $code;
    }
    
    public static function randomChars($numChars)
    {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        //Return the characters.
        return substr(str_shuffle($str), 0, $numChars);
    }
}
