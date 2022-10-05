<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_request_district".
 *
 * @property integer $request_district_id
 * @property string $name
 */
class Requestdistrict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request_district';
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
            [['name'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_district_id' => 'Request District ID',
            'name' => 'Name',
        ];
    }
}
