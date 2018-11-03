<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Klasemen extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array(
            "menuTitle" => "Data Klasemen"
        );
        $this->template->write_view('menu', 'menu', $data, TRUE);
    }

    function index() {
        $this->load->model('commite/Standing_model', 'Standing');

        $data = $this->Standing->getAll();

        $this->template->write('title', 'Klasemen', TRUE);
        $this->template->write_view('content', 'klasemen', array('data' => $data), TRUE);
        $this->template->render();
    }
}