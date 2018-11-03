<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Team extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array("menuTitle" => "Data Team", 'modulUrl'=> base_url('commite'));
        $this->template->write_view('menu', 'menu', $data, TRUE);
        $this->load->model('Team_model', 'Team');
    }

    function index() {
        $data = $this->Team->getAll();

        $this->template->write('title', 'Commite | Team', TRUE);
        $this->template->write_view('content', 'team', array('data' => $data), TRUE);
        $this->template->render();
    }
}