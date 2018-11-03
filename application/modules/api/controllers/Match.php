<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');

class Match extends Rest {
    public function __construct() {
        parent::__construct();
        $this->cekToken();
        $this->load->model('Matchhistory_model');
        $this->load->model('Team_model');
        $this->load->model('Standing_model');
    }
    
    public function index_post(){
        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);
        $rivalId = $this->post('rival_id');
        $teamScore = $this->post('team_score');
        $rivalScore = $this->post('rival_score');
        $matchDate = $this->post('match_date');
        $matchResult = $this->post('match_result');

        $params = array(
            'team_id' => $teamId,
            'rival_id' => $rivalId,
            'team_score' => $teamScore,
            'rival_score' => $rivalScore,
            'match_date' => $matchDate
        );

        if($this->Matchhistory_model->insert($params) ) {
            $this->Standing_model->update($teamId, $rivalId, $matchResult);
            $this->set_response('success', REST_Controller::HTTP_OK);
        } else {
            $this->set_response('failed', REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function histories_get(){

        $status = $this->input->get('status');
        $userId = $this->getUserIdFromToken();

        $teamId = $this->Team_model->getTeamIdFrom($userId);

        if(isset($status)) {
            $this->response($this->Matchhistory_model->all($teamId, $status)); 
        } else {
            $this->response($this->Matchhistory_model->all($teamId)); 
        }
    }

    public function notification_get() {
        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);

        $this->response($this->Matchhistory_model->findScoreNotificationFromRival($teamId)); 
    }

    public function notification_put($matchHistoryId) {
        if($this->Matchhistory_model->update($matchHistoryId, $this->put())) {
            $this->set_response('success', REST_Controller::HTTP_OK);
        } else {
            $this->set_response('failed', REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}