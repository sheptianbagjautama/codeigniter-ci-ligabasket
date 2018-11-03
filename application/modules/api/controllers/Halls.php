<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');

class Halls extends Rest {
    public function __construct() {
        parent::__construct();
        $this->load->model('Hall_model');
        $this->cekToken();
    }
    
    public function index_get(){
        $vendorId = $this->input->get('vendor_id');

        if(isset($vendorId)) {
            $this->response($this->Hall_model->findByVendorId($vendorId)); 
        } else {
            $this->response($this->Hall_model->all()); 
        }
    }

}