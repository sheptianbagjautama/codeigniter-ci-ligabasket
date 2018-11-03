<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_penyewaan extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array('menuTitle' => 'Data Penyewaan', 'modulUrl'=> base_url('vendor'));
        $this->template->write_view('menu', 'menu', $data, TRUE);
        $this->template->write_view('_scripts', 'script_data_penyewaan', NULL, TRUE);
        $this->load->model('vendor/Invoice_model', 'Invoice');
    }

    function index() {
        $this->load->helper('url');
        $status = array('order', 'accepted');

        $data = $this->Invoice->getAll($status);

        $this->template->write('title', 'Vendor | Data Penyewaan', TRUE);
        $this->template->write_view('content', 'data_penyewaan', array('data' => $data), TRUE);
        $this->template->render();
    }

    function update() {
        $invoiceId = $this->input->post('invoiceId');
        $status = $this->input->post('status');

        $this->output->set_content_type('application/json');
        if($this->Invoice->update($invoiceId, $status)) {
            $this->output
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'status' => 'success',
            )));
        } else {
            $this->output
                ->set_status_header(500)
                ->set_output(json_encode(array(
                    'status' => 'failed',
                )));
        }
    }
}