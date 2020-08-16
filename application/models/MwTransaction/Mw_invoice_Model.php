<?php

class Mw_invoice_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $userData = getUserData();
        $this->UserId = $userData->UserId;
    }

    public function createInvoice() {
        $data = $this->encdec->loadjson();

        $insert_array = array(
            "user_id" => $this->UserId,
            "c_id" => $data->cust_id,
            "summary" => $data->invSummary,
            "amount" => $data->invTotalAmt,
            "billimg_name" => ''
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

    public function getAllInvoices($params) {
        $this->db->trans_start();

        $this->db->select('*');
        foreach ($params AS $pKey => $pVal) {
            $this->db->where($pKey . "='" . $pVal . "'");
        }
        $this->db->from('mw_service');
        $this->db->where('user_id = ' . $this->UserId);
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

}

?>
