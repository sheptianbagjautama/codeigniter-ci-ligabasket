<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/libraries/REST_Controller.php');
require_once(APPPATH.'modules/api/libraries/Format.php');

require_once(APPPATH . 'modules/api/libraries/JWT.php');
use \Firebase\JWT\JWT;

class Rest extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->secretkey = getenv('SECRET_KEY');
    }

    public function cekToken(){
        $this->load->model('User_model');
        
        $jwt = $this->input->get_request_header('Authorization');


        try {
            $decode = JWT::decode($jwt,$this->secretkey,array('HS256'));


            if ($this->User_model->is_valid_num($decode->email)>0) {
                return true;
            }
        } catch (Exception $e) {
            $this->set_response('unauthorized', REST_Controller::HTTP_UNAUTHORIZED);
            exit(json_encode(array('status' => '0' ,'message' => 'Invalid Token',)));
        }
    }

    public function getUserIdFromToken() {
        $jwt = $this->input->get_request_header('Authorization');
        try {
            $decode = JWT::decode($jwt,$this->secretkey,array('HS256'));
            return $decode->id;
        } catch (Exception $e) {
            exit(json_encode(array('status' => '0' ,'message' => 'Invalid Token', 'error' => $e)));
        }
    }
    

    public function generate_token() {
        $email = $this->post('email');
        $password = $this->post('password');
        $invalidLogin = ['invalid' => $email];
        if(!$email || !$password) $this->response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);
        if($this->ion_auth->login($email,$password)) {
            $token['id'] = $this->session->userdata('user_id');
            $token['email'] = $email;
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            $token['exp'] = $date->getTimestamp() + 3600*24;  //expired dalam satu hari
            $output['token'] = JWT::encode($token, $this->secretkey);
            $output['user_id'] = $this->session->userdata('user_id');
            $this->set_response($output, REST_Controller::HTTP_OK);
        }
        else {
            $this->set_response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);
        }
    }


}