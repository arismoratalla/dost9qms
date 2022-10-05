<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_expenditure_class".
 *
 * @property integer $expenditure_class_id
 * @property string $name
 * @property string $code
 *
 * @property ExpenditureSubClass[] $expenditureSubClasses
 */
class Expenditureclass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_expenditure_class';
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
            [['name', 'code'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expenditure_class_id' => 'Expenditure Class ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureSubClasses()
    {
        return $this->hasMany(ExpenditureSubClass::className(), ['expenditure_class_id' => 'expenditure_class_id']);
    }
}
