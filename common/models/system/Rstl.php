<?php

namespace common\models\system;

use Yii;

/**
 * This is the model class for table "tbl_rstl".
 *
 * @property integer $rstl_id
 * @property integer $region_id
 * @property string $name
 * @property string $code
 */
class Rstl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_rstl';
    }
    public static function getDb()
    {
        return \Yii::$app->db;  
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'name', 'code'], 'required'],
            [['region_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rstl_id' => 'ID',
            'region_id' => 'Region ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }
}
