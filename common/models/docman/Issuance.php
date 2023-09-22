<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_issuance".
 *
 * @property integer $issuance_id
 * @property integer $issuance_type_id
 * @property string $code
 * @property string $subject
 * @property string $file
 * @property string $date
 */
class Issuance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_issuance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['issuance_type_id', 'subject', 'file'], 'required'],
            [['issuance_type_id'], 'integer'],
            [['subject'], 'string'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 25],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, png, jpeg'], // adjust extensions as needed
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'issuance_id' => 'Issuance ID',
            'issuance_type_id' => 'Issuance Type',
            'code' => 'Code',
            'subject' => 'Subject',
            'file' => 'File',
            'date' => 'Date',
        ];
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getType() 
    { 
        return $this->hasOne(Issuancetype::className(), ['issuance_type_id' => 'issuance_type_id']); 
    }
}
