<?php

namespace common\models\system;

use Yii;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property integer $comment_id
 * @property integer $component_id
 * @property integer $record_id
 * @property string $message
 */
class Comment extends \yii\db\ActiveRecord
{
    const COMPONENT_REQUEST = 10;   
    const COMPONENT_ATTACHMENT = 20;   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['component_id', 'record_id', 'message'], 'required'],
            [['component_id', 'record_id'], 'integer'],
            [['create_date'], 'safe'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'component_id' => 'Component ID',
            'record_id' => 'Record ID',
            'message' => 'Message',
            'create_date' => 'Date',
        ];
    }
}
