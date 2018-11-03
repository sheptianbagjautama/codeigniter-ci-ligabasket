<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Panitia extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array(
            "menuTitle" => "Data Panitia"
        );
        $this->template->write_view('menu', 'menu', $data, TRUE);
        $this->load->model('admin/User_model', 'user');
    }

    function index() {
        $data = $this->user->getAll('commite');

        $this->template->write('title', 'Panitia', TRUE);
        $this->template->write_view('content', 'panitia', array('data' => $data), TRUE);
        $this->template->render();
    }
}