<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_likelihood_scale".
 *
 * @property integer $likelihood_id
 * @property string $scale
 */
class Likelihoodscale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_likelihood_scale';
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
            'likelihood_id' => 'Likelihood ID',
            'scale' => 'Scale',
        ];
    }
}
