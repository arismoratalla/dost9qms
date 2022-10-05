<?php

namespace common\models\finance;

use Yii;

use common\models\cashier\Lddapadaitem;
use common\models\procurement\Type;
use common\models\procurement\Expenditureclass;
/**
 * This is the model class for table "tbl_osdv".
 *
 * @property integer $osdv_id
 * @property integer $request_id
 * @property integer $type_id
 * @property integer $expenditure_class_id
 * @property integer $status_id
 * @property integer $created_by
 */
class Osdv extends \yii\db\ActiveRecord
{
    public $dv_id;
    public $os_id;
    public $payee_id;
    public $cashAvailable;
    public $request_number;
    public $subjectToAda;
    public $supportingDocumentsComplete;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_osdv';
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
            [['request_id', 'type_id', 'status_id', 'created_by'], 'required'],
            [['create_date', 'cancelled'], 'safe'],
            [['request_id', 'type_id', 'expenditure_class_id', 'status_id', 'created_by'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'osdv_id' => 'Osdv ID',
            'request_id' => 'Request ID',
            'type_id' => 'Type ID',
            'expenditure_class_id' => 'Expenditure Class ID',
            'status_id' => 'Status ID',
            'create_date' => 'Date Created',
            'created_by' => 'Created By',
        ];
    }
    
    public function getOs()  
    {  
      return $this->hasOne(Os::className(), ['osdv_id' => 'osdv_id'])->andOnCondition(['deleted' => 0]);  
    }
    
    public function getAllotments()  
    {  
      return $this->hasMany(Osallotment::className(), ['osdv_id' => 'osdv_id'])->andOnCondition(['active' => 1]);  
    }
    
    public function getAccounttransactions()  
    {  
      return $this->hasMany(Accounttransaction::className(), ['request_id' => 'osdv_id'])->andOnCondition(['active' => 1]);  
    }
    
    public function getDv()  
    {  
      return $this->hasOne(Dv::className(), ['osdv_id' => 'osdv_id']);  
    }
    
    public function getRequest()  
    {  
      return $this->hasOne(Request::className(), ['request_id' => 'request_id']);  
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayrollitems()
    {
        return $this->hasMany(Requestpayroll::className(), ['osdv_id' => 'osdv_id'])->andOnCondition(['tbl_request_payroll.active' => 1]);
    }
    
    public function getStatus()
    {
        return $this->hasOne(Requeststatus::className(), ['request_status_id' => 'status_id']);
    }
    
    public function getType()  
    {  
      return $this->hasOne(Type::className(), ['type_id' => 'type_id']);  
    }
    
    public function getExpenditureClass()  
    {  
      return $this->hasOne(Expenditureclass::className(), ['expenditure_class_id' => 'expenditure_class_id']);  
    }
    
    public function getAccountID()  
    {  
      $account = Accounttransaction::find()->where(['request_id' => $this->osdv_id, 'debitcreditflag' => 1])->orderBy(['account_transaction_id' => SORT_DESC])->one();
      return $account ? $account->account_id : 0;  
    }
    
    public function getNetamount()
    {
        switch ($this->type_id) {
          case 1:
            $accountId = 3;
            break;
          case 2:
            $accountId = 91;
            break;
          case 3:
            $accountId = 91;            
            break;
          case 4:
            $accountId = 4; 
            break;
          default:
            $accountId = 0;
        }
        
        $taxable = Accounttransaction::find()->where(['request_id' => $this->osdv_id, 'account_id' => $accountId])->orderBy(['account_transaction_id' => SORT_DESC])->one();
        
        if($taxable){
            $tax = $this->computeTax($taxable);
            return $taxable->amount - $tax;
        }else{
            return $this->request->amount;
        }
    }
    
    public function getTax2()
    {
        $tax_amount = 0.00;
        
        switch ($model->tax_category_id) {
          case 1: //Goods (5% + 1%); check if 10k above; if below 10 check if supplier is tagged(amount divide by 1.12%)
                if($model->osdv->request->creditor->tagged || $model->tax_registered)
                    $taxable_amount = round($model->amount / 1.12, 2);
                else
                    $taxable_amount = $model->amount;

                if($model->osdv->request->creditor->tagged || $model->amount >= 10000.00){
                    $tax1 = round($taxable_amount * $model->rate1, 2);
                    $tax2 = round($taxable_amount * $model->rate2, 2);
                    $tax_amount = $tax1 + $tax2;
                }else{
                    $tax_amount = round($taxable_amount * $model->rate1, 2);
                }
            break;
                
          case 2: // Services  (5% + 2%); check if 10k above; if below 10 check if supplier is tagged(amount divide by 1.12%)
                if($model->osdv->request->creditor->tagged || $model->tax_registered)
                    $taxable_amount = round($model->amount / 1.12, 2);
                else
                    $taxable_amount = $model->amount;

                if($model->osdv->request->creditor->tagged || $model->amount >= 10000.00){
                    $tax1 = round($taxable_amount * $model->rate1, 2);
                    $tax2 = round($taxable_amount * $model->rate2, 2);
                    $tax_amount = $tax1 + $tax2;
                }else{
                    $tax_amount = round($taxable_amount * $model->rate1, 2);
                }
            break;
                
          case 3: //Rental  (5%)
                $tax_amount = round($model->amount * $model->rate1, 2);
            break;
                
          case 4: //Professional (10%)
                $tax_amount = round($model->amount * $model->rate1, 2);
            break;
    
          case 5: //Computed
                $transaction = Accounttransaction::find()->where(['request_id' => $this->osdv_id, 'account_id' => 31, 'debitcreditflag' => 2, ])->orderBy(['account_transaction_id' => SORT_DESC])->one();
                $tax_amount = $transaction->amount;
            break;
          //default:
            //code to be executed if n is different from all labels;
        }
        
        return $tax_amount;
    }
    
    public function getTax()
    {
        switch ($this->type_id) {
          case 1:
            $accountId = 3;
            break;
          case 2:
            $accountId = 91;
            break;
          case 3:
            $accountId = 91;            
            break;
          case 4:
            $accountId = 4; 
            break;
          default:
            $accountId = 0;
        }
        
        $taxable = Accounttransaction::find()->where(['request_id' => $this->osdv_id, 'account_id' => $accountId, 'debitcreditflag' => 2])->orderBy(['account_transaction_id' => SORT_DESC])->one();

        if($taxable){
            $tax = $this->computeTax($taxable);
            return $tax;
        }else{
            return 0.00;
        }
    }
    
    public function getGrossamount()
    {
        return $this->request->amount;
    }
    
    private function computeTax($model)
    {
        /*$tax_amount = 0.00;
        
        if($model->tax_registered)
            $taxable_amount = round($model->amount / 1.12, 2);
        else
            $taxable_amount = $model->amount;

        if($model->amount < 10000.00){
            $tax_amount = round($taxable_amount * $model->rate1, 2);
        }else{
            $tax1 = round($taxable_amount * $model->rate1, 2);
            $tax2 = round($taxable_amount * $model->rate2, 2);
            $tax_amount = $tax1 + $tax2;
        }
        //return $taxable_amount;
        return $tax_amount;*/
        $tax_amount = 0.00;

        
        switch ($model->tax_category_id) {
          case 0:
            if($model->osdv->request->creditor->tagged || $model->tax_registered)
                    $taxable_amount = round($model->amount / 1.12, 2);
                else
                    $taxable_amount = $model->amount;

                if($model->osdv->request->creditor->tagged || $model->amount >= 10000.00){
                    $tax1 = round($taxable_amount * $model->rate1, 2);
                    $tax2 = round($taxable_amount * $model->rate2, 2);
                    $tax_amount = $tax1 + $tax2;
                }else{
                    $tax_amount = round($taxable_amount * $model->rate1, 2);
                }
            break;        
            
          case 1: //Goods (5% + 1%); check if 10k above; if below 10 check if supplier is tagged(amount divide by 1.12%)
                if($model->osdv->request->creditor->tagged || $model->tax_registered)
                    $taxable_amount = round($model->amount / 1.12, 2);
                else
                    $taxable_amount = $model->amount;

                if($model->osdv->request->creditor->tagged || $model->amount >= 10000.00){
                    $tax1 = round($taxable_amount * $model->rate1, 2);
                    $tax2 = round($taxable_amount * $model->rate2, 2);
                    $tax_amount = $tax1 + $tax2;
                }else{
                    $tax_amount = round($taxable_amount * $model->rate1, 2);
                }
            break;

          case 2: // Services  (5% + 2%); check if 10k above; if below 10 check if supplier is tagged(amount divide by 1.12%)
                if($model->osdv->request->creditor->tagged || $model->tax_registered)
                    $taxable_amount = round($model->amount / 1.12, 2);
                else
                    $taxable_amount = $model->amount;

                if($model->osdv->request->creditor->tagged || $model->amount >= 10000.00){
                    $tax1 = round($taxable_amount * $model->rate1, 2);
                    $tax2 = round($taxable_amount * $model->rate2, 2);
                    $tax_amount = $tax1 + $tax2;
                }else{
                    $tax_amount = round($taxable_amount * $model->rate1, 2);
                }
            break;

          case 3: //Rental  (5%)
                $tax_amount = round($model->amount * $model->rate1, 2);
            break;

          case 4: //Professional (10%)
                $tax_amount = round($model->amount * $model->rate1, 2);
            break;
        
          case 5: //Computed
                $transaction = Accounttransaction::find()->where(['request_id' => $model->request_id, 'account_id' => 31, 'debitcreditflag' => 2, ])->orderBy(['account_transaction_id' => SORT_DESC])->one();
                $tax_amount = $transaction->amount;
            break;
          
        }

        return $tax_amount;
    }
    
    public function getUacs()  
    {  
      return $this->hasOne(Osallotment::className(), ['osdv_id' => 'osdv_id'])->andOnCondition(['active' => 1]);  
    }
    
    
    public function getLddapadaitem()  
    {  
      return $this->hasOne(Lddapadaitem::className(), ['osdv_id' => 'osdv_id'])->andOnCondition(['active' => 1]);  
    }
    
    public function isObligated()
    {
        return ($this->status_id >= Request::STATUS_ALLOTTED) ? true : false;
    }
    
    public function isCharged()
    {
        return ($this->status_id >= Request::STATUS_CHARGED) ? true : false;
    }
    

}