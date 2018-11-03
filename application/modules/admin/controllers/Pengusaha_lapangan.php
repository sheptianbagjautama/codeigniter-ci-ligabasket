<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengusaha_lapangan extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array(
            "menuTitle" => "Data Pengusaha Lapangan"
        );
        $this->template->write_view('menu', 'menu', $data, TRUE);
        $this->load->model('admin/User_model', 'user');
    }

    function index() {
        $data = $this->user->getAll('vendor');

        $this->template->write('title', 'Pengusaha Lapangan', TRUE);
        $this->template->write_view('content', 'pengusaha_lapangan', array('data' => $data), TRUE);
        $this->template->render();
    }
}