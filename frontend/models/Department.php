<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_department".
 *
 * @property integer $department_id
 * @property string $department_name
 * @property string $department_desc
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_department';
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
            [['department_name'], 'string', 'max' => 100],
            [['department_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
            'department_desc' => 'Department Desc',
        ];
    }
}
