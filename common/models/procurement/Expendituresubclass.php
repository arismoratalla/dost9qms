<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_expenditure_sub_class".
 *
 * @property integer $expenditure_sub_class_id
 * @property integer $expenditure_class_id
 * @property string $name
 * @property string $class_code
 *
 * @property ExpenditureObject[] $expenditureObjects
 * @property ExpenditureClass $expenditureClass
 */
class Expendituresubclass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_expenditure_sub_class';
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
            [['expenditure_class_id', 'name', 'class_code'], 'required'],
            [['expenditure_class_id'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['class_code'], 'string', 'max' => 20],
            [['expenditure_class_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExpenditureClass::className(), 'targetAttribute' => ['expenditure_class_id' => 'expenditure_class_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expenditure_sub_class_id' => 'Expenditure Sub Class ID',
            'expenditure_class_id' => 'Expenditure Class ID',
            'name' => 'Name',
            'class_code' => 'Class Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureObjects()
    {
        return $this->hasMany(Expenditureobject::className(), ['expenditure_sub_class_id' => 'expenditure_sub_class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureClass()
    {
        return $this->hasOne(Expenditureclass::className(), ['expenditure_class_id' => 'expenditure_class_id']);
    }
}
