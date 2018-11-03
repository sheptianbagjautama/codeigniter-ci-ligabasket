<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

require_once(APPPATH.'modules/api/controllers/Rest.php');



class Standings extends Rest {

    public function __construct() {

        parent::__construct();

        $this->load->model('Standing_model');

        $this->cekToken();

    }

    

    public function index_get(){

        $teamName = $this->input->get('team');

        if ($this->input->get('lat') != "" && $this->input->get('lng') != "" || $this->input->get('lat') != 0 && $this->input->get('lng') != 0) {
            $this->response($this->Standing_model->findByTeamNearby($teamName, $this->input->get('lat'), $this->input->get('lng')));
        }



        if(isset($teamName)) {

            $this->response($this->Standing_model->findByTeam($teamName)); 

        } else {

            $this->response($this->Standing_model->all()); 

        }

    }

}