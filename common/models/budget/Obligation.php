<?php

namespace common\models\budget;

use Yii;

/**
 * This is the model class for table "tbl_obligation".
 *
 * @property integer $obligation_id
 * @property integer $financial_request_id
 * @property string $obligation_number
 * @property string $obligation_date
 */
class Obligation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_obligation';
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
            [['financial_request_id'], 'required'],
            [['financial_request_id'], 'integer'],
            [['obligation_date'], 'safe'],
            [['obligation_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'obligation_id' => 'Obligation ID',
            'financial_request_id' => 'Financial Request ID',
            'obligation_number' => 'Obligation Number',
            'obligation_date' => 'Obligation Date',
        ];
    }
}
