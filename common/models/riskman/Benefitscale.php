<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_benefit_scale".
 *
 * @property integer $benefit_id
 * @property string $scale
 */
class Benefitscale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_benefit_scale';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scale'], 'required'],
            [['scale'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'benefit_id' => 'Benefit ID',
            'scale' => 'Scale',
        ];
    }
}
