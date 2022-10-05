<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_request_type".
 *
 * @property integer $request_type_id
 * @property string $name
 * @property string $default_text
 * @property integer $active
 */
class Requesttype extends \yii\db\ActiveRecord
{
    public $documents;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('procurementdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'default_text', 'active'], 'required'],
            [['default_text'], 'string'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_type_id' => 'Request Type ID',
            'name' => 'Name',
            'default_text' => 'Default Text',
            'active' => 'Active',
            'documents' => 'Documents',
        ];
    }
    
    public function getRequesttypeattachments()
    {
        return $this->hasMany(Requesttypeattachment::className(), ['request_type_id' => 'request_type_id'])
            ->andOnCondition(['active' => 1]);
            //->orderBy([`attachment`.`name`=>SORT_ASC]);
    }
}
