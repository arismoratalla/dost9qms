<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_sub_type".
 *
 * @property integer $subtype_id
 * @property integer $type_id
 * @property string $name
 *
 * @property Type $type
 */
class Subtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sub_type';
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
            [['type_id', 'name'], 'required'],
            [['type_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subtype_id' => 'Subtype ID',
            'type_id' => 'Type ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['type_id' => 'type_id']);
    }
}
