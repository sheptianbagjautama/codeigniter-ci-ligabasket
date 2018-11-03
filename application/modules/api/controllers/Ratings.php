<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');

class Ratings extends Rest {
    public function __construct() {
        parent::__construct();
        $this->cekToken();
        $this->load->model('Rating_model');
        $this->load->model('Team_model');
    }

    public function index_post(){
        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);

        $params = array(
            'rating_from' => $teamId,
            'team_id' => $this->post('team_id'),
            'sportsmanship' => $this->post('sportsmanship'),
            'teamwork' => $this->post('teamwork'),
            'ability' => $this->post('ability')
        );

        if($this->Rating_model->insert($params) ) {
            $this->set_response('success', REST_Controller::HTTP_OK);
        } else {
            $this->set_response('failed', REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}