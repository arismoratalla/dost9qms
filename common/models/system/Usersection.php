<?php

namespace common\models\system;

use common\models\system\Profile;
use common\models\procurement\Section;
use Yii;

/**
 * This is the model class for table "tbl_user_section".
 *
 * @property integer $user_section_id
 * @property integer $user_id
 * @property integer $section_id
 * @property integer $access
 */
class Usersection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'section_id', 'project_id', 'access'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_section_id' => 'User Section ID',
            'user_id' => 'User ID',
            'section_id' => 'Section ID',
            'project_id' => 'Project ID',
            'access' => 'Access',
        ];
    }
    
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }
    
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['section_id' => 'section_id']);
    }
}
