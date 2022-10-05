<?php

namespace common\models\sec;

use Yii;
use yii\base\Model;


class Block extends Model
{
    public $index;
    public $scope;
    public $timestamp;
    public $data;
    public $previousHash;
    public $hash;
    public $nonce;

    public function __construct($index, $scope, $timestamp, $data, $previousHash = NULL)
    {
        $this->index = $index;
        $this->scope = $scope;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->hash = $this->calculateHash();
        $this->nonce = $timestamp;
    }

    public function calculateHash()
    {
        //return hash("sha256", $this->index.$this->previousHash.$this->timestamp.((string)$this->data).$this->nonce);
        return hash("sha256", $this->index.$this->previousHash.$this->timestamp.((string)$this->data).$this->nonce);
    }
    
    public function generateNonce()
    {
        return 12345667890;
    }
}
