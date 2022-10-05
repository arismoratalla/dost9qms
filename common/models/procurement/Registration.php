<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_registration".
 *
 * @property integer $id
 * @property string $name
 * @property string $student_num
 * @property integer $checked_in
 * @property integer $gender
 */
class Registration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_registration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'gender'], 'required'],
            [['checked_in', 'gender'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['student_num'], 'string', 'max' => 25],
            [['duration_start', 'duration_end', 'winner'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'student_num' => 'Student Num',
            'checked_in' => 'Checked In',
            'gender' => 'Gender',
        ];
    }
}
