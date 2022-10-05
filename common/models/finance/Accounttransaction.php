<?php

namespace common\models\finance;

use Yii;

/**
 * This is the model class for table "tbl_account_transaction".
 *
 * @property integer $account_transaction_id
 * @property integer $request_id
 * @property integer $account_id
 * @property integer $transaction_type
 * @property double $amount
 */
class Accounttransaction extends \yii\db\ActiveRecord
{
    const DEBIT = 10;
    const CREDIT = 20;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account_transaction';
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
            [['request_id', 'account_id', 'transaction_type', 'amount'], 'required'],
            [['request_id', 'account_id', 'transaction_type', 'tax_registered', 'debitcreditflag'], 'integer'],
            [['amount','rate1','rate2'], 'number'],
            [['check_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_transaction_id' => 'Account Transaction ID',
            'request_id' => 'Request ID',
            'account_id' => 'Account ID',
            'transaction_type' => 'Transaction Type',
            'amount' => 'Amount',
            'debitcreditflag' => 'Entry Type',
        ];
    }
    
    /*public function afterFind()
    {
        if($this->taxable){
            $tax_amount = 0.00;
            if($this->tax_registered)
                $taxable_amount = round($this->amount / 1.12, 2);
            else
                $taxable_amount = $this->amount;

            if($this->amount < 10000.00){
                $tax_amount = round($taxable_amount * $this->rate1, 2);
            }else{
                $tax1 = round(($taxable_amount * $this->rate1), 2);
                $tax2 = round(($taxable_amount * $this->rate2), 2);
                $tax_amount = $tax1 + $tax2;
            }

            if($this->debitcreditflag == 2)
                $this->amount = round($this->amount - $tax_amount, 2);
            else
                $this->amount = round($tax_amount, 2);
        }else{
            $this->amount = $this->amount;
        }
        
        return parent::afterFind();
    }*/
    
    public function getNetAmount()
    {
        if($this->taxable){
            $tax = $this->computeTax($this);
            return $this->amount - $tax;
        }else{
            return $this->amount;
        }
    }
    
    public function getNetAmount2()
    {
        if($this->taxable){
            $tax_amount = 0.00;
            if($this->tax_registered)
                $taxable_amount = round($this->amount / 1.12, 2);
            else
                $taxable_amount = $this->amount;

            if($this->amount < 10000.00){
                $tax_amount = round($taxable_amount * $this->rate1, 2);
            }else{
                $tax1 = round(($taxable_amount * $this->rate1), 2);
                $tax2 = round(($taxable_amount * $this->rate2), 2);
                $tax_amount = $tax1 + $tax2;
            }

            if($this->debitcreditflag == 2)
                $this->amount = round($this->amount - $tax_amount, 2);
            else
                $this->amount = round($tax_amount, 2);
        }else{
            $this->amount = $this->amount;
        }
        
        return $this->amount;
    }
    
    private function computeTax($model)
    {
        $tax_amount = 0.00;
        
        switch ($model->tax_category_id) {
          case 0:
            if($model->osdv->request->creditor->tagged || $model->tax_registered)
                    $taxable_amount = round($model->amount / 1.12, 2);
                else
                    $taxable_amount = $model->amount;

                if($model->osdv->request->creditor->tagged || $model->amount > 10000.00){
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

                if($model->osdv->request->creditor->tagged || $model->amount > 10000.00){
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

                if($model->osdv->request->creditor->tagged || $model->amount > 10000.00){
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
    
    public function getAccount()  
    {  
      return $this->hasOne(Account::className(), ['account_id' => 'account_id']);  
    } 
    
    public function getTaxcategory()  
    {  
      return $this->hasOne(Taxcategory::className(), ['tax_category_id' => 'tax_category_id']);  
    } 
    
    public function getOsdv()  
    {  
      return $this->hasOne(Osdv::className(), ['osdv_id' => 'request_id']);  
    } 
}
