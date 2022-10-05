<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_category".
 *
 * @property integer $category_id
 * @property string $name
 * @property string $code
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_category';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        // return Yii::$app->get('dmsdb');
        return Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }
}
