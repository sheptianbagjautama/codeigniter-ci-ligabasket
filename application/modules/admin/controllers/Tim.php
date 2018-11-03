<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tim extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array(
            "menuTitle" => "Data Tim"
        );
        $this->template->write_view('_scripts', 'script_tim', $data, TRUE);
        $this->template->write_view('menu', 'menu', $data, TRUE);
        $this->load->model('Team_model', 'Team');
    }

    function index() {
        $data = $this->Team->getAll();

        $this->template->write('title', 'Tim', TRUE);
        $this->template->write_view('content', 'tim',  array('data' => $data), TRUE);
        $this->template->render();
    }
}