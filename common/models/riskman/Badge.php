<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_badge".
 *
 * @property integer $badge_id
 * @property string $module_id
 * @property string $name
 * @property string $description
 * @property string $criteria
 * @property string $award_type
 * @property string $icon
 * @property string $date_created
 * @property string $date_modified
 */
class Badge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_badge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'name', 'description', 'criteria', 'award_type', 'icon'], 'required'],
            [['award_type'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['module_id'], 'string', 'max' => 25],
            [['name', 'icon'], 'string', 'max' => 50],
            [['description', 'criteria'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'badge_id' => 'Badge ID',
            'module_id' => 'Module ID',
            'name' => 'Name',
            'description' => 'Description',
            'criteria' => 'Criteria',
            'award_type' => 'Award Type',
            'icon' => 'Icon',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
        ];
    }
}
