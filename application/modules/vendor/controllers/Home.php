<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('vendor/Hall_model', 'Hall');
        $this->load->model('vendor/Invoice_model', 'Invoice');
        $data = array(
            'menuTitle' => 'Home', 'modulUrl'=> base_url('vendor')
        );
        $this->template->write_view('menu', 'menu', $data, TRUE);
    }

    function index() {
        $data = array(
            'hallsCount'=> $this->Hall->count(),
            'billsCount'=> $this->Invoice->count(),
        );
        $this->template->write('title', 'Vendor | Home', TRUE);
        $this->template->write_view('content', 'home', $data, TRUE);
        $this->template->render();
    }
}