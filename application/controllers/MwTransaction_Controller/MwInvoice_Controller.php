<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MwInvoice_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MwTransaction/Mw_invoice_Model');
    }

    public function createInvoice() {
        $returnData = $this->Mw_invoice_Model->createInvoice();
        echo $this->encdec->returnjson($returnData);
    }

    public function listInvoice() {
        $returnData = $this->Mw_invoice_Model->listInvoice();
        echo $this->encdec->returnjson($returnData);
    }

    public function getInvoice() {
        $data = $this->encdec->loadjson();
        $array = json_decode(json_encode($data), true);
        $returnData = $this->Mw_invoice_Model->getInvoice($array);
        echo $this->encdec->returnjson($returnData);
    }

    public function searchInvoice() {
        $returnData = $this->Mw_invoice_Model->searchInvoice();
        echo $this->encdec->returnjson($returnData);
    }

    public function getInvoiceAutocomp() {
        $returnData = $this->Mw_invoice_Model->listCustomer();
        echo $this->encdec->returnjson($returnData);
    }

    public function deleteInvoice() {
        $data = $this->encdec->loadjson();
        $array = json_decode(json_encode($data), true);
        
        $returnData = $this->Mw_invoice_Model->deleteInvoice($array['inv_id']);
        $returnData['invid'] = $array['inv_id'];
        echo $this->encdec->returnjson($returnData);
    }
    
    public function editInvoice() {
        $returnData = $this->Mw_invoice_Model->listInvoice();
        echo $this->encdec->returnjson($returnData);
    }
    
}
