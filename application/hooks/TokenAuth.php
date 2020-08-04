<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
class TokenAuth {  
	public function  checkToken(){
		$cObj = get_instance();
    

        if (array_key_exists('avoidCI', $cObj->router->routes)) {

	    	if(!in_array(get_class($cObj), $cObj->router->routes['avoidCI'])){
	  			if(!validate_token()){
                   $returnData =au_authorizedData();
                    echo $cObj->encdec->returnjson($returnData);
					exit;
                }
            }
        }
	  

		
	}

}  
    ?>  