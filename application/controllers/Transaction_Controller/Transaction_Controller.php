<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaction_Controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Transaction/Transaction_Model');

    }
    
 /**
    
     *Purpose:Create Deal
     * @param  
     * @return Response Array
     * created BY: Nayan Sanadi
     * created on : 24/7/2020
     * modified on : 
     */
    /***
     * input format
{
  
  "TransactionTypeId": "1",
  "PaymentMethodId": "1",
  "ItemId": "1",
  "Weight": "1",
  "ExpectedPrice": "1",
  "StatusId": "1",
}
     */
	
    public function createDeal()
    {
      
      
       $returnData=$this->Transaction_Model->createDeal();
       echo $this->encdec->returnjson($returnData);
    }


    
    
}