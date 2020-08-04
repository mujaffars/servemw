<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MwTransaction_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MwTransaction/Mw_customers_Model');
    }

    public function createCustomer() {
        $returnData = $this->Mw_customers_Model->createCustomer();
        echo $this->encdec->returnjson($returnData);
    }

    public function listCustomer() {
        $returnData = $this->Mw_customers_Model->listCustomer();
        echo $this->encdec->returnjson($returnData);
    }

    public function searchCustomer() {
        $returnData = $this->Mw_customers_Model->searchCustomer();
        echo $this->encdec->returnjson($returnData);
    }

    public function getCustomerAutocomp() {
        $returnData = $this->Mw_customers_Model->listCustomer();
        echo $this->encdec->returnjson($returnData);
    }

}
