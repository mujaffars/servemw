<?php
////nayan Sanadi developer start Working on time table model
class Transaction_Model extends CI_Model {

	function __construct(){
		parent::__construct(); 
		$userData=getUserData();
		$this->UserId=$userData->UserId;
		
    }
    
   
/**
    
     *Purpose: create Deal
     * @param  
     * @return Response Array
     * created BY: Nayan Sanadi
     * created on : 24/7/2020
     * modified on :
     */
    public function createDeal()
    {   

        $data=$this->encdec->loadjson(); 
       
        $this->db->trans_start();

        $invValid = $this->validateCreateInv($data);
        
        if($invValid){
        $result_array=array(
            "UserId"=>$this->UserId,
            "TransactionTypeId"=>$data->TransactionTypeId,
            "PaymentMethodId"=>$data->PaymentMethodId,
            "ItemId"=>$data->ItemId,
            "Weight"=>$data->Weight,
            "ExpectedPrice"=>$data->ExpectedPrice,
            "StatusId"=>$data->StatusId,
            "IsActive"=>"1",
            "CreatedDate"=>DATE('Y-m-d H:i:s'),
            "EndDealTime"=>date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +1 minutes")),
            "CreatedBy"=>$this->UserId,
            
        );
        
        $flag=1;
        $message="Error While Create Deal";
        if($this->db->insert("transaction",$result_array))
        {
            $flag=0;
            $message="Create Deal successfully";
        }

        if($this->db->trans_status()==FALSE)
        {
            $this->db->trans_rollback();
            $resultdata['code']=1;
            $resultdata['data']=[];
            $resultdata['result']='Erro while add create deal';
        }
        else{
            $this->db->trans_commit();
            $resuldata['code']=$flag;
            $resuldata['data']=[];
            $resuldata['result']=$message;
        }
        
        return $resuldata;
        }
        
    }

  
    

}
?>
