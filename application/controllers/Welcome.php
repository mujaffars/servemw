
<?php
/**
    * start working On school Project
    *Purpose: school other works
    * @param  
    * @return Response Array
    * created BY: Yogesh Rade
    * created on : 5/11/2019
    * modified on :
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		//clear the every previous cache from browser.............
		parent::__construct();
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	}
	// public function deleteJob(){
	// 	$this->load->library('crontab');
	// 	$this->crontab->removeJob(JOB);
	// 	echo "in function ";
	// }


	
	public function index()
	{
		$resultdata['code']=0;
		$resultdata['data']=[];
		$resultdata['message']="success";
		echo json_encode($resultdata);
		//$this->load->view("encode_decode");
	}
	public function test()
	{
		echo "okk";
	}
	
	public function overridePage(){
	 	$returnData['code']   = 404;
		$returnData['result'] = "Page Not Found";
		$returnData['data']   = NULL;
		echo $this->encdec->returnjson($returnData);
 	}

	
}
	
?>
