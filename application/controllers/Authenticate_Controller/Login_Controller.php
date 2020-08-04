<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Login_Controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
					

		$this->load->model('Authenticate_Model/Login_Model');
    }
   
	/**
    
     *Purpose: login user API
     * @param  
     * @return Response Array
     * created BY: Nayan Sanadi
     * created on :24/7/2020
     * modified on :
     */
	
    public function UserLogin()
    {

    
         $returnData=$this->Login_Model->Login();
		 echo $this->encdec->returnjson($returnData);
        
    }

    
    
  
   function logout()
  {
      $returnData=destroyToke();
      echo json_encode($returnData,JSON_NUMERIC_CHECK);
  }
	
}