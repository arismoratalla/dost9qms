<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_consequence_scale".
 *
 * @property integer $consequence_id
 * @property string $scale
 */
class Consequencescale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_consequence_scale';
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
            'consequence_id' => 'Consequence ID',
            'scale' => 'Scale',
        ];
    }
}
