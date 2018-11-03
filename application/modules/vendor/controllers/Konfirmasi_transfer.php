<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Konfirmasi_transfer extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array('menuTitle' => 'Konfirmasi Transfer', 'modulUrl'=> base_url('vendor'));
        $this->template->write_view('_scripts', 'script_data_penyewaan', NULL, TRUE);
        $this->template->write_view('menu', 'menu', $data, TRUE);
        $this->load->model('vendor/Invoice_model', 'Invoice');
    }

    function index() {
        $this->load->helper('url');
        $status = array('paid', 'confirmed');


        $data = $this->Invoice->getAll($status);

        $status = array('paid', 'confirmed');

        $this->template->write('title', 'Vendor | Konfirmasi Transfer', TRUE);
        $this->template->write_view('content', 'konfirmasi_transfer', array('data' => $data), TRUE);
        $this->template->render();
    }
}