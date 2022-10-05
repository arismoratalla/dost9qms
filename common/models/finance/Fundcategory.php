<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_fund_category".
 *
 * @property integer $fund_category_id
 * @property string $name
 * @property integer $active
 */
class Fundcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_fund_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fund_category_id' => 'Fund Category ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
}
