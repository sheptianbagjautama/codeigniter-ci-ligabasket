<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');

class Events extends Rest {
    public function __construct() {
        parent::__construct();
        $this->load->model('Event_model');
        $this->load->model('Team_model');
        $this->cekToken();
    }

    public function index_get($eventId=NULL){
        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);
        if($eventId) {
            $this->response($this->Event_model->findByTeamId($teamId, $eventId, $userId));
        } else {
            $this->response($this->Event_model->findByTeamId($teamId));
        }
    }


    public function location_get() {
        $userId = $this->getUserIdFromToken();
        $latitude = $this->input->get("latitude");
        $longitude = $this->input->get("longitude");

        
        $this->response($this->Event_model->findEventCurrentLocation($latitude, $longitude));
    }

}