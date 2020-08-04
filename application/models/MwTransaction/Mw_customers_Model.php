<?php
////nayan Sanadi developer start Working on time table model
class Mw_customers_Model extends CI_Model {

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
    public function createCustomer()
    {   
        $data=$this->encdec->loadjson();	

		$custData = $this->getCustomer(array('vehicle_no' => $data->vehicle_no));
		
		if(!$custData){
			$result_array=array(
				"user_id"=> 1,
				"first_name"=>$data->firstname,
				"last_name"=>$data->lastname,
				"vehicle_no"=>$data->vehicle_no,
				"mobile_no"=>$data->mobile_no            
			);
			
			$flag=1;
			$message="Error While Create Customer";
			
			$this->db->trans_start();
			if($this->db->insert("mw_customers",$result_array))
			{
				$flag=0;
				$message="Customer created successfully";
			}

			if($this->db->trans_status()==FALSE)
			{
				$this->db->trans_rollback();
				$resultdata['code']=1;
				$resultdata['data']=[];
				$resultdata['result']='Erro while Creating customer';
			}
			else{
				$this->db->trans_commit();
				$resuldata['code']=$flag;
				$resuldata['data']=[];
				$resuldata['result']=$message;
			}
        }else{
			$resuldata['code']=1;
			$resuldata['data']=[];
			$resuldata['result']="Customer already exit!!!";
		}
        return $resuldata;        
        
    }

	public function listCustomer()
    {   
        $data=$this->encdec->loadjson();
		
        $this->db->trans_start();
        
        $flag=1;
        $message="Error While Create Customer";
		
		$this->db->select('*');
		$this->db->from('mw_customers');
		
        return $this->db->get()->result();        
        
    }
  
	public function getCustomer($params){
		$this->db->trans_start();
		
		$this->db->select('*');
		foreach($params AS $pKey => $pVal){
			$this->db->where($pKey."='".$pVal."'");
		}
		$this->db->from('mw_customers');
		$custRow = $this->db->get()->row();
		
		if($custRow){
			return $custRow;
		}else{
			return null;
		}
	}
    
	public function searchCustomer(){
		$this->db->trans_start();
		$data=$this->encdec->loadjson();
		
		
	}

}
?>
