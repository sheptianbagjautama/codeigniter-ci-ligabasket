<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');


class Teams extends Rest {
    public function __construct() {
        parent::__construct();
        $this->load->model('Team_model');
    }

    public function index_get($teamId=NULL){
        $this->cekToken();

        if($teamId) {
            $this->load->model('Standing_model');
            $this->load->model('Rating_model');

            
            $resp = $this->Team_model->detail($teamId);

            $resp['standings'] = $this->Standing_model->findByTeamId($teamId);
            $resp['ratings'] = $this->Rating_model->findByTeamId($teamId);

            $this->response($resp); 
        } else {
            $this->set_response('Invalid endpoint', REST_Controller::HTTP_NOT_FOUND);
        }
        
    }

    public function recomended_get() {
        $this->cekToken();

        $userId = $this->getUserIdFromToken();
        $teamId = $this->Team_model->getTeamIdFrom($userId);

        $resp = $this->Team_model->getRecomendedTeam($teamId);
        $this->response($resp);
    }

    public function register_post(){
        $this->load->model('User_model');

        $name = $this->post('name');
        $email = $this->post('email');
        $password = $this->post('password');
        $phone = $this->post('phone');

        $additional_data = array('name' => $name, 'phone'=> $phone);
        

        $groups = array(3); // groupId 3 sebagai team
        $invalidRegister = 'invalid params';

        if(!$email || !$password || !$name) {
            $this->response($invalidRegister, REST_Controller::HTTP_BAD_REQUEST);
        } 
        if($userId = $this->ion_auth->register('', $password, $email, $additional_data, $groups)) {
            
            $teamParams = array(
                'user_id'=> $userId ,
                'name' => $name
            );

            if($this->post('description')) {
                $teamParams['description'] = $this->post('description');
            }

            if($this->post('address')) {
                $teamParams['address'] = $this->post('address');
            }

            $config = array(
                'upload_path' => "./media/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'file_ext_tolower' => TRUE,
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'file_name' =>  now()
            );

            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('image')){
                $teamParams['image'] = $this->upload->data()['file_name'];
            }

            if($teamId = $this->Team_model->insert($teamParams) ) {
                $this->load->model('Standing_model');
                $standingParams = array(
                    'team_id' => $teamId
                );
                $this->Standing_model->insert($standingParams);
            }
            $this->set_response(array('message'=> 'success', 'userId'=>$userId), REST_Controller::HTTP_OK);
        } else {
            $this->set_response($invalidRegister, REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }

    public function login_post() {
        $this->generate_token();
    }

    public function profile_get() {
        $this->cekToken();
        $userId = $this->getUserIdFromToken();
        $this->response($this->Team_model->getTeamFrom($userId)); 
    }
}