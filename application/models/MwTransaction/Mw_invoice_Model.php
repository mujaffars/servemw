<?php

class Mw_invoice_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $userData = getUserData();
        $this->UserId = $userData->UserId;
    }

    public function createInvoice() {
        $data = $this->encdec->loadjson();

        $invValid = $this->validateCreateInv($data);

        if ($invValid['datavalid']) {
            $insert_array = array(
                "user_id" => $this->UserId,
                "c_id" => $data->cust_id,
                "summary" => $data->invSummary,
                "invdate" => $data->invdate,
                "amount" => $data->invTotalAmt,
                "billimg_name" => '',
                "kmrun" => $data->vehicleKmrun,
                "reservice_date" => $data->reservice_date
            );

            $flag = 1;
            $message = "Error While Create Invoice";

            $this->db->trans_start();
            if ($this->db->insert("mw_service", $insert_array)) {
                $flag = 0;
                $message = "Invoice created successfully";
            }

            if ($this->db->trans_status() == FALSE) {
                $this->db->trans_rollback();
                $resultdata['code'] = 1;
                $resultdata['data'] = [];
                $resultdata['result'] = 'Erro while Creating Invoice';
            } else {
                $this->db->trans_commit();
                $resultdata['code'] = $flag;
                $resultdata['data'] = [];
                $resultdata['result'] = $message;
            }

            // Update the Re-Servicing date for Customer
            if ($data->reservice_date) {
                $this->load->model('MwTransaction/Mw_customers_Model', 'customer');
                $result = $this->customer->updateReServeDate($data->reservice_date, $data->cust_id);
            }
        } else {
            $resultdata['code'] = 1;
            $resultdata['result'] = implode("<br/>", $custValid['errors']);
        }

        return $resultdata;
    }

    public function listInvoice() {
        $data = $this->encdec->loadjson();

        $this->db->trans_start();

        $flag = 1;
        $message = "Error While Create Invoice";

        $this->db->select('*');
        $this->db->where('user_id = ' . $this->UserId);
        $this->db->from('mw_service');
        $this->db->order_by('id DESC');

        return $this->db->get()->result();
    }

    public function getInvoice($params) {
        $this->db->trans_start();

        $this->db->select('*');
        foreach ($params AS $pKey => $pVal) {
            $this->db->where($pKey . "='" . $pVal . "'");
        }
        $this->db->where('user_id = ' . $this->UserId);
        $this->db->from('mw_service');
        $custRow = $this->db->get()->row();

        if ($custRow) {
            return $custRow;
        } else {
            return null;
        }
    }

    public function getAllInvoices($params = null) {
        $this->db->trans_start();

        $this->db->select('*');

        if ($params) {
            foreach ($params AS $pKey => $pVal) {
                $this->db->where($pKey . "='" . $pVal . "'");
            }
        }
        $this->db->from('mw_service');
        $this->db->where('user_id = ' . $this->UserId);
        $this->db->where('is_active', '1');
        $this->db->order_by('invdate DESC');
        $custRow = $this->db->get()->result();

        if ($custRow) {
            return $custRow;
        } else {
            return null;
        }
    }

    public function searchInvoice() {
        $this->db->trans_start();
        $data = $this->encdec->loadjson();
    }

    public function validateCreateInv($postData) {

        $dataErrors = array();
        if (!is_numeric($postData->invTotalAmt)) {
            $dataErrors[] = 'Invalid total amount';
        }
        if (strlen($postData->invSummary) > 500) {
            $dataErrors[] = 'Summary length is too long';
        }
        if (!is_numeric($postData->vehicleKmrun)) {
            $dataErrors[] = 'Invalid Km details';
        }

        $test_arr = explode('-', $postData->invdate);

//        if (!checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
//            $dataErrors[] = 'Invalid invoice date';
//        }
//
//        $test_arr = explode('-', $postData->reservice_date);
//        if (!checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
//            $dataErrors[] = 'Invalid re-service date';
//        }

        if (count($dataErrors)) {
            return array('datavalid' => false, 'errors' => $dataErrors);
        } else {
            return array('datavalid' => true);
        }
    }

    public function deleteInvoice($invId) {
        $this->db->set('is_active', '0');
        $this->db->where('id', $invId);
        $this->db->where('user_id = ' . $this->UserId);
        $this->db->update('mw_service');

        $resultdata['code'] = 0;
        $resultdata['result'][] = 'Invoice deleted successfully';

        return $resultdata;
    }

    public function dashboardDtl() {
        $arrInvoices = $this->getAllInvoices();

        $arrMonthTotal = array();
        
        $arrMonthTotal[date('M-Y')]='';
        for ($i = 1; $i < 6; $i++) {
            $arrMonthTotal[date('M-Y', strtotime("-$i month"))]='';
        }
        
        foreach($arrInvoices As $rowInv){
            $invKey = date('M-Y', strtotime($rowInv->invdate));
            if(array_key_exists($invKey,$arrMonthTotal)){
                $arrMonthTotal[$invKey] = (float)$arrMonthTotal[$invKey] + (float)$rowInv->amount;
            }
        }
        
        $maxAmount = max($arrMonthTotal);
        
        foreach ($arrMonthTotal As $arrKey=>$arrVal){
            
            $arrMonthTotal[$arrKey] = (float)$arrMonthTotal[$arrKey]."_".((float)$arrVal*100/$maxAmount);
        }
        return $arrMonthTotal;
    }

}

?>
