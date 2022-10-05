<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_request_type_attachment".
 *
 * @property integer $request_type_attachment_id
 * @property integer $request_type_id
 * @property integer $attachment_id
 * @property integer $active
 */
class Requesttypeattachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request_type_attachment';
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
            [['request_type_id', 'attachment_id', 'active'], 'required'],
            [['request_type_id', 'attachment_id', 'active'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_type_attachment_id' => 'Request Type Attachment ID',
            'request_type_id' => 'Request Type ID',
            'attachment_id' => 'Attachment ID',
            'active' => 'Active',
        ];
    }
    
    public function getAttachment()
    {
        return $this->hasOne(Attachment::className(), ['attachment_id' => 'attachment_id'])->andOnCondition(['active' => 1]);
    }
}
