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
            "user_id" => 1,
            "c_id" => 2,
            "summary" => $data->summary,
            "amount" => $data->amount,
            "billimg_name" => ''
        );

        $flag = 1;
        $message = "Error While Create Invoice";

        $this->db->trans_start();
        if ($this->db->insert("mw_service", $result_array)) {
            $flag = 0;
            $message = "Customer created successfully";
        }

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            $resultdata['code'] = 1;
            $resultdata['data'] = [];
            $resultdata['result'] = 'Erro while Creating customer';
        } else {
            $this->db->trans_commit();
            $resuldata['code'] = $flag;
            $resuldata['data'] = [];
            $resuldata['result'] = $message;
        }

        return $resuldata;
    }

    public function listInvoice() {
        $data = $this->encdec->loadjson();

        $this->db->trans_start();

        $flag = 1;
        $message = "Error While Create Invoice";

        $this->db->select('*');
        $this->db->from('mw_service');

        return $this->db->get()->result();
    }

    public function getInvoice($params) {
        $this->db->trans_start();

        $this->db->select('*');
        foreach ($params AS $pKey => $pVal) {
            $this->db->where($pKey . "='" . $pVal . "'");
        }
        $this->db->from('mw_service');
        $custRow = $this->db->get()->row();

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
