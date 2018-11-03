<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Klasemen extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array("menuTitle" => "Data Klasemen", 'modulUrl'=> base_url('commite'));
        $this->template->write_view('menu', 'menu', $data, TRUE);
        $this->load->model('Standing_model', 'Standing');
    }

    function index() {
        $data = $this->Standing->getAll();

        $this->template->write('title', 'Commite | Klasemen', TRUE);
        $this->template->write_view('content', 'klasemen', array('data' => $data), TRUE);
        $this->template->render();
    }
}