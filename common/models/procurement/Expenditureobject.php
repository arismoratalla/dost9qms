<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_expenditure_object".
 *
 * @property integer $expenditure_object_id
 * @property integer $expenditure_sub_class_id
 * @property string $name
 * @property integer $object_code
 *
 * @property ExpenditureSubClass $expenditureSubClass
 */
class Expenditureobject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_expenditure_object';
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
            [['expenditure_sub_class_id', 'name', 'object_code'], 'required'],
            [['expenditure_sub_class_id', 'object_code'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['expenditure_sub_class_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expendituresubclass::className(), 'targetAttribute' => ['expenditure_sub_class_id' => 'expenditure_sub_class_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expenditure_object_id' => 'Expenditure Object ID',
            'expenditure_sub_class_id' => 'Expenditure Sub Class ID',
            'name' => 'Name',
            'object_code' => 'Object Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureSubClass()
    {
        return $this->hasOne(Expendituresubclass::className(), ['expenditure_sub_class_id' => 'expenditure_sub_class_id']);
    }
}
