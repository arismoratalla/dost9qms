<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_expense_class".
 *
 * @property integer $id
 * @property integer $expenditureId
 * @property string $name
 * @property string $classCode
 */
class Expenseclass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_expense_class';
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
            [['expenditureId', 'name', 'classCode'], 'required'],
            [['expenditureId'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['classCode'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expenditureId' => 'Expenditure ID',
            'name' => 'Name',
            'classCode' => 'Class Code',
        ];
    }
}
