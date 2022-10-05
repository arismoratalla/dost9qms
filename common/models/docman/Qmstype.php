<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_qms_type".
 *
 * @property integer $qms_type_id
 * @property string $title
 * @property string $code
 */
class Qmstype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_qms_type';
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
            [['title', 'code'], 'required'],
            [['title'], 'string', 'max' => 200],
            [['code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qms_type_id' => 'Qms Type ID',
            'title' => 'Title',
            'code' => 'Code',
        ];
    }
}
