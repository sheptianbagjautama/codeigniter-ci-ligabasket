<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');

class Schedules extends Rest {
    public function __construct() {
        parent::__construct();
        $this->load->model('Schedule_model');
        $this->cekToken();
    }
    
    public function index_get(){
        $hallId = NULL;
        $date = NULL;
        if($this->get('hall_id')) {
            $hallId = $this->get('hall_id');
        }

        if($this->get('date')) {
            $date = $this->get('date');
        }
        $this->load->model('vendor/Hallschedule_model', 'HallSchedule');
        header('Content-Type: application/json');
        echo json_encode( $this->HallSchedule->get($hallId, $date));
    }

}