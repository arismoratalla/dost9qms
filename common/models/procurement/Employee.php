<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_employee".
 *
 * @property integer $employee_id
 * @property string $employee_code
 * @property string $lastname
 * @property string $firstname
 * @property string $middlename
 * @property string $address
 * @property string $dob
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_employee';
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
            [['dob'], 'safe'],
            [['employee_code', 'lastname', 'firstname', 'middlename'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'employee_code' => 'Employee Code',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'address' => 'Address',
            'dob' => 'Dob',
        ];
    }
}
