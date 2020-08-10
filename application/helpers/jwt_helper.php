<?php

ob_start();

function create_token($data1) {

    $CI = &get_instance();

    $key = $CI->config->item('key');
    // Create token header as a JSON string
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

    // Create token payload as a JSON string

    if (function_exists('random_bytes')) {
        $tokenId = base64_encode(random_bytes(32));
    } else if (function_exists('mcrypt_create_iv')) {
        $tokenId = base64_encode(mcrypt_create_iv(32));
    }
    $issuedAt = time();
    $notBefore = $issuedAt + 10;             //Adding 10 seconds
    $expire = $notBefore + 60;            // Adding 60 seconds
    $serverName = $_SERVER['HTTP_HOST'];
    ; // Retrieve the server name from 
    //in data name not given _,/,+,=,-,_
    $jwt_data = [
        'jti' => $tokenId,
        'iss' => $serverName, // Issuer
        'data' => $data1
    ];



    $payload = json_encode($jwt_data);
    $payload = json_encode($jwt_data);
    $jwt = $CI->encdec->encrypt($payload);



    return $jwt;
}

function validate_token() {

    $CI = &get_instance();
    $tokendata = json_decode($CI->encdec->decrypt(GLOBAL_TOKEN));
    $flag = FALSE;
    if (isset($tokendata)) {
        $userdata = $tokendata->data;

        $UserId = $userdata->UserId; //user_ref_id 
        $result_array = array(
            "UserId" => $UserId,
            "user_token" => GLOBAL_TOKEN,
        );

        //get user token from table user_mater
        $CI->db->select("count(*) as total");
        $CI->db->from("user");
        $CI->db->where($result_array);
        $checkCount = $CI->db->get()->row()->total;


        if ($checkCount == 1) {

            $flag = TRUE;
        } else {

            $flag = FALSE;
        }
    }



    return $flag;
    //get Data from 
}

function au_authorizedData() {
    $result['code'] = 2;
    $result['data'] = [];
    $result['result'] = 'UN-Authorized';
    
    return 'unauthorized';
    return $result;
}

function deleteToken() {
    $CI = &get_instance();
    $headerdata = apache_request_headers();
    $useragent = $headerdata['User-Agent'];
    $origin = $_SERVER['REMOTE_ADDR'];
    $user_ref_id = $CI->session->userdata('user_ref_id');

    $condition = array(
        'user_ref_id' => $user_ref_id,
        'user_agent' => $useragent,
        'host_name' => $origin);
    $CI->db->where($condition);
    $CI->db->delete('tbl_token_auth');
}

function getuserdata() {
    $CI = &get_instance();
    $tokendata = json_decode($CI->encdec->decrypt(GLOBAL_TOKEN));

    if (isset($tokendata)) {


        return $tokendata->data;
    } else {
        $data = (object) array(
                    "UserId" => '',
        );
        return $data;
    }
}

function destroyToke() {
    $CI = &get_instance();
    $headerdata = apache_request_headers();
    $useragent = $headerdata['User-Agent'];
    $origin = $_SERVER['REMOTE_ADDR'];
    $userData = getUserData();

    $CI->db->trans_start();
    $condition = array(
        'user_ref_id' => $userData['user_ref_id'],
        'user_agent' => $useragent,
        'host_name' => $origin);
    $CI->db->where($condition);
    $CI->db->delete('tbl_token_auth');

    $CI->db->trans_complete();
    if ($CI->db->trans_status() == FALSE) {
        $CI->db->trans_rollback();
        $resultdata['code'] = 1;
        $resultdata['data'] = [];
        $resultdata['result'] = 'Erro while deleting token';
    } else {
        $CI->db->trans_commit();
        $resultdata['code'] = 0;
        $resultdata['data'] = [];
        $resultdata['result'] = 'token delete succssfully';
    }
    return $resultdata;
}
?>  
