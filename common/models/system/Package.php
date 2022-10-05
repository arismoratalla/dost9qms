<?php

namespace common\models\system;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_package".
 *
 * @property integer $PackageID
 * @property string $PackageName
 * @property string $icon
 * @property integer $updated_at
 * @property integer $created_at
 */
class Package extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_package';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PackageName'], 'required'],
            [['updated_at','created_at'], 'integer'],
            [['PackageName', 'icon'], 'string', 'max' => 100],
            [['PackageName'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PackageID' => 'Package ID',
            'PackageName' => 'Package Name',
            'icon' => 'Icon',
            'updated_at' => 'Updated At',
            'created_at'=>'Created_At',
        ];
    }
}
