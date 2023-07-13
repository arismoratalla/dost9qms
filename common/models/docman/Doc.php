<?php

namespace common\models\docman;

use Yii;

/**
 * This is the model class for table "tbl_doc".
 *
 * @property integer $doc_id
 * @property integer $subcategory_id
 * @property string $code
 * @property string $name
 * @property string $file
 * @property integer $functional_unit_id
 * @property integer $status_id
 */
class Doc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subcategory_id', 'name'], 'required'],
            [['subcategory_id', 'functional_unit_id', 'status_id'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name', 'file'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doc_id' => 'Doc ID',
            'subcategory_id' => 'Subcategory ID',
            'code' => 'Code',
            'name' => 'Name',
            'file' => 'File',
            'functional_unit_id' => 'Functional Unit ID',
            'status_id' => 'Status ID',
        ];
    }

    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['subcategory_id' => 'subcategory_id']);
    }
}
