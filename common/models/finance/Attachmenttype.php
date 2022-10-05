<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_attachment_type".
 *
 * @property integer $attachment_type_id
 * @property string $name
 * @property integer $active
 */
class Attachmenttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_attachment_type';
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
            [['name', 'active'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attachment_type_id' => 'Attachment Type ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
}
