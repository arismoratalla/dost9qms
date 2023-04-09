<?php

namespace common\models\docman;

use Yii;

use common\models\system\User;

/**
 * This is the model class for table "tbl_functional_unit".
 *
 * @property integer $functional_unit
 * @property integer $qms_type_id
 * @property string $name
 * @property string $code
 */
class Functionalunit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_functional_unit';
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
            [['qms_type_id', 'name', 'code'], 'required'],
            [['qms_type_id'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'functional_unit' => 'Functional Unit',
            'qms_type_id' => 'Qms Type ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }

    public function getUnithead()
    {
        return $this->hasOne(User::className(), ['user_id' => 'unit_head']);
    }
}
