<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');

class Broadcasts extends Rest {
    public function __construct() {
        parent::__construct();
        $this->cekToken();
        $this->load->model('Broadcast_model');
        $this->load->model('Team_model');
    }

    public function index_post() {
        
        $message = $this->post('message'); 
        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);
        $params = array(
            'team_id' => $teamId,
            'message' => $message,
        );

        if($this->Broadcast_model->insert($params) ) {
            $this->set_response('success', REST_Controller::HTTP_OK);
        } else {
            $this->set_response('failed', REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_get() {
        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);

        $this->response($this->Broadcast_model->all($teamId)); 
        
    }
    
}