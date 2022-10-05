<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_votes".
 *
 * @property integer $id
 * @property string $class
 * @property string $entry
 * @property integer $votes
 */
class Votes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_votes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class', 'entry', 'votes'], 'required'],
            [['votes'], 'integer'],
            [['class'], 'string', 'max' => 15],
            [['entry'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class' => 'Class',
            'entry' => 'Entry',
            'votes' => 'Votes',
        ];
    }
}
