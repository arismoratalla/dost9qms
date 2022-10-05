<?php

namespace common\models\sec;

use Yii;

use common\models\finance\Osdv;
use common\models\finance\Request;
use common\models\finance\Requesttype;
use common\models\system\Profile;

/**
 * This is the model class for table "tbl_blockchain".
 *
 * @property integer $blockchain_id
 * @property integer $index_id
 * @property string $scope
 * @property string $timestamp
 * @property string $data
 * @property string $previoushash
 * @property string $hash
 * @property integer $nonce
 */
class Blockchain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_blockchain';
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
            [['index_id', 'scope', 'data', 'hash', 'nonce'], 'required'],
            [['index_id', 'nonce'], 'integer'],
            [['timestamp'], 'safe'],
            [['scope'], 'string', 'max' => 25],
            [['data'], 'string', 'max' => 256],
            [['previoushash', 'hash'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'blockchain_id' => 'Blockchain ID',
            'index_id' => 'Index ID',
            'scope' => 'Scope',
            'timestamp' => 'Timestamp',
            'data' => 'Data',
            'previoushash' => 'Previoushash',
            'hash' => 'Hash',
            'nonce' => 'Nonce',
        ];
    }
    
    public function getProfile()  
    {  
      return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);  
    }
    
    public function getRequest()  
    {  
      return $this->hasOne(Request::className(), ['request_id' => 'index_id']);  
    }
    
    public function getOsdv()  
    {  
      return $this->hasOne(Osdv::className(), ['osdv_id' => 'index_id']);  
    }
    
    /**
     * Creates the genesis block.
     */
    public static function createBlock($index, $scope, $data)
    {
        date_default_timezone_set('Asia/Manila');
        $timestamp = time();
        
        $block = new Blockchain();
        $block->index_id = $index;
        $block->scope = $scope;
        $block->timestamp = $timestamp;
        $block->data = $data;
        //$block->previousHash = $previousHash;
        $block->hash = $block->calculateHash();
        $block->nonce = $timestamp;
        $block->user_id = Yii::$app->user->identity->user_id;
        $block->save();
        
        return $block;
    }
    
    /**
     * Gets the last block of the chain.
     */
    public static function getLastBlock($index, $scope)
    {
        $block = Blockchain::find()->where(['index_id' => $index, 'scope' => $scope])->orderBy(['blockchain_id' => SORT_DESC])->one();
        return $block;
        //return $this->chain[count($this->chain)-1];
    }

    public function calculateHash2($index, $scope, $data)
    {
        $block = Blockchain::find()->where(['index_id' => $index, 'scope' => $scope])->orderBy(['blockchain_id' => SORT_DESC])->one();
        $this->previoushash = $block ? $block->hash : NULL;
        
        return hash("sha256", $index.$this->previoushash.$this->timestamp.((string)$this->data).$this->nonce);
    }
    
    public function calculateHash()
    {
        $block = Blockchain::find()->where(['index_id' => $this->index_id, 'scope' => $this->scope])->orderBy(['blockchain_id' => SORT_DESC])->one();
        $this->previoushash = $block ? $block->hash : NULL;
        
        return hash("sha256", $this->index_id.$this->previoushash.$this->timestamp.((string)$this->data).$this->nonce);
    }
    
    public static function getChain($index, $scope)
    {
        return Blockchain::find()->where(['index_id' => $index, 'scope' => $scope])->asArray()->all();
    }
    
    public static function createRequestBlockchain($index, $status)
    {
        $model = Request::findOne($index); 
        $scope = 'Request';
        $particulars = (strlen($model->particulars) > 200 ) ? substr($model->particulars, 0, 200) : $model->particulars;

        $data = $model->request_number.':'.$model->request_date.':'.$model->request_type_id.':'.$model->payee_id.':'.$particulars.':'.$model->amount.':'.$status;
        
        $blockchain = Blockchain::createBlock($index, $scope, $data);

        return $blockchain ? "Success" : $blockchain->getErrors();
    }
    
    
    public static function format_interval($interval) {
        $result = "";
        if ($interval->y) { $result .= $interval->format("%y years "); }
        if ($interval->m) { $result .= $interval->format("%m months "); }
        if ($interval->d) { $result .= $interval->format("%d days "); }
        if ($interval->h) { $result .= $interval->format("%h hours "); }
        if ($interval->i) { $result .= $interval->format("%i minutes "); }
        //if ($interval->s) { $result .= $interval->format("%s seconds "); }

        return $result;
    }
}
