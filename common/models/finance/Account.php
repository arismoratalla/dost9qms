<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_account".
 *
 * @property integer $account_id
 * @property string $title
 * @property string $object_code
 * @property string $account_code
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account';
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
            [['title', 'object_code', 'account_code'], 'required'],
            [['title'], 'string', 'max' => 200],
            [['object_code', 'account_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_id' => 'Account ID',
            'title' => 'Title',
            'object_code' => 'Object Code',
            'account_code' => 'Account Code',
        ];
    }
}
