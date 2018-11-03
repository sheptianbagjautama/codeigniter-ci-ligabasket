<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');

class Vendors extends Rest {
    public function __construct() {
        parent::__construct();
        $this->load->model('Vendor_model');
        $this->cekToken();
    }
    
    public function index_get(){
         $this->response($this->Vendor_model->all());

    }
}