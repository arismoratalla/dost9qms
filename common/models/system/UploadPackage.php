<?php

namespace common\models\system;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "tbl_upload_package".
 *
 * @property integer $upload_id
 * @property string $package_name
 * @property string $module_name
 * @property integer $created_at
 * @property integer $updated_at
 */
class UploadPackage extends \yii\db\ActiveRecord
{
    public $upload;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_upload_package';
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
            [['created_at', 'updated_at'], 'integer'],
            [['package_name', 'title'], 'string', 'max' => 100],
            [['upload'], 'file', 'extensions' => 'zip'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => 'Upload ID',
            'package_name' => 'Package Name',
            'module_name' => 'Module Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
