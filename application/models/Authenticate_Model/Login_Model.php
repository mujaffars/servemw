<?php
////nayan Sanadi developer start Working on time table model
class Login_Model extends CI_Model {

	function __construct(){
		parent::__construct(); 
		
		
    }
    
   
/**
    
     *Purpose: login User wise API 
     * @param  
     * @return Response Array
     * created BY: Nayan Sanadi
     * created on : 24/7/2020
     * modified on :
     */
    public function Login()
    {   

        $data=$this->encdec->loadjson(); 
        $UserName=$data->UserName;
        $password=$data->password;

        $Encpasswords = $this->encdec->encrypt($password,-1);

        $result_array=array(
            'UserName'=>$UserName,
            'Password'=>$Encpasswords,
        );

            $this->db->select("UserId,user_role,CONCAT(FirstName,' ',LastName) AS user_name,
                               CASE WHEN user_role=1 THEN 'Admin' ELSE 'Other User' END AS userRoleName,
                                Address,city,ContactNumber1,ContactNumber2,IsAdmin,IsActive,CreatedDate,ModifiedDate,
                                CreatedBy,ModifiedBy,user_token");
            $this->db->from("user");
            $this->db->where($result_array);
            $userData=$this->db->get();

            if($userData->num_rows()==1)
            {
                $userData=$userData->row();
                $user_token=$userData->user_token;
                $UserId=$userData->UserId;

                if($user_token!='' && $user_token!=null && $user_token!=0)
                {
                    $token=$user_token;
                }
                else{
                    $result_data=array(
                        'UserId'=>$UserId,
                        
                    );
                     $tokendata=create_token($result_data);
                     if($tokendata!='')
                    {
                            $this->db->set('user_token',$tokendata);
                            $this->db->where('UserId',$UserId);
                            $this->db->update("user");
                            $flag=0;
                            $message="User Login Successfully";
                            $finalData['userData']=$userData;
                            $finalData['token']=$tokendata;
                    }
                    else{
                        $flag=1;
                        $message="Error while token generation";
                        $finalData['userData']=null;
                        $finalData['token']=null;
                    }
                }

            }
            else{
             $flag=1;
             $message="Invalid User Name OR Password";
             $finalData['userData']=null;
             $finalData['token']=null;
            }

            $resuldata['code']=$flag;
            $resuldata['data']=$finalData;
            $resuldata['result']=$message;
            return $resuldata;
    }

  
    

}
?>
