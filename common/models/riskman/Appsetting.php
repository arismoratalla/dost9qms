<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_app_setting".
 *
 * @property integer $app_setting_id
 * @property string $module
 * @property string $name
 * @property string $code
 * @property integer $setting
 */
class Appsetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_app_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module', 'name', 'code', 'setting'], 'required'],
            [['setting'], 'integer'],
            [['module'], 'string', 'max' => 20],
            [['name', 'code'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'app_setting_id' => 'App Setting ID',
            'module' => 'Module',
            'name' => 'Name',
            'code' => 'Code',
            'setting' => 'Setting',
        ];
    }
}
