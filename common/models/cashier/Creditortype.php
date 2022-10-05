<?php

namespace common\models\cashier;

use Yii;

/**
 * This is the model class for table "tbl_creditor_type".
 *
 * @property integer $creditor_type_id
 * @property string $name
 * @property integer $active
 */
class Creditortype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_creditor_type';
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
            [['name'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'creditor_type_id' => 'Creditor Type ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
}
