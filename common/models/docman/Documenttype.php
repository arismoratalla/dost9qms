<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_document_type".
 *
 * @property integer $document_type_id
 * @property string $name
 */
class Documenttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_document_type';
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'document_type_id' => 'Document Type ID',
            'name' => 'Name',
        ];
    }
}
