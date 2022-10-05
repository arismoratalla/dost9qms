<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_request_status".
 *
 * @property integer $request_status_id
 * @property string $name
 * @property integer $active
 */
class Requeststatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request_status';
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
            [['name'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_status_id' => 'Request Status ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
}
