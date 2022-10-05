<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_requirement".
 *
 * @property integer $requirement_id
 * @property integer $qms_type_id
 * @property string $name
 * @property integer $active
 */
class Requirement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_requirement';
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
            [['qms_type_id', 'name'], 'required'],
            [['qms_type_id', 'active'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'requirement_id' => 'Requirement ID',
            'qms_type_id' => 'Qms Type ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
}
