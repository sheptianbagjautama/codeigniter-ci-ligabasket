<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');

class Invitations extends Rest {
    public function __construct() {
        parent::__construct();
        $this->load->model('Matchinvitation_model');
        $this->load->model('Team_model');
        $this->cekToken();
    }

    public function request_get(){
        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);
        $resp = $this->Matchinvitation_model->all($teamId);
        if($resp) {
            $this->response($resp); 
        } else {
            $this->set_response('not found', REST_Controller::HTTP_NOT_FOUND);
        }
        
    }

    public function index_get($invitationId=NULL){
        $this->load->model('Standing_model');

        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);
        $resp = $this->Matchinvitation_model->allReverse($teamId, $invitationId);

        if($resp) {
            if($invitationId) {
                $resp['standings'] = $this->Standing_model->findByTeamId($teamId);
            } else {
                foreach ($resp as &$item) {
                    $item['standings'] = $this->Standing_model->findByTeamId($item['rival_id']);
                }
            }
            
            $this->response($resp); 
        } else {
            $this->set_response('not found', REST_Controller::HTTP_NOT_FOUND);
        }
        
    }

    
    public function index_post(){
        $message = $this->post('message'); 
        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);
        $rivalId = $this->post('rival_id');
        $hallId = $this->post('hall_id');
        $matchDate = $this->post('match_date');
        $contactNumber = $this->post('contact_number');

        $params = array(
            'team_id' => $teamId,
            'rival_id' => $rivalId,
            'hall_id' => $hallId,
            'match_date' => $matchDate,
            'contact_number' => $contactNumber
        );

        if(isset($message)) {
            $params['message'] = $message;
        }

        if($this->Matchinvitation_model->insert($params) ) {
            $this->set_response('success', REST_Controller::HTTP_OK);
        } else {
            $this->set_response('failed', REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function update_put($invitationId){
        if($this->Matchinvitation_model->update($invitationId, $this->put())) {
            
            $this->set_response('success', REST_Controller::HTTP_OK);
        } else {
            $this->set_response('failed', REST_Controller::HTTP_BAD_REQUEST);
        }
    }


}