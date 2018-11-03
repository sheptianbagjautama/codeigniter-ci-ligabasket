<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_lapangan extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array('menuTitle' => 'Data Lapangan', 'modulUrl'=> base_url('vendor'));
        $this->template->write_view('_scripts', 'script', $data, TRUE);
        $this->template->write_view('menu', 'menu', $data, TRUE);
        $this->load->model('vendor/Hall_model', 'Hall');

        $this->formData = array(
            'menuTitle' => 'Add Lapangan',
			'csrf' => array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			),
			'labelAttr' => array('class' => 'col-sm-4 col-form-label'),
			'inputAttr' => array('class' => 'form-control')
        );

    }

    function index() {
        $data = $this->Hall->getAll();

        $this->template->write('title', 'Vendor | Data Lapangan', TRUE);
        $this->template->write_view('content', 'data_lapangan', array('data' => $data), TRUE);
        $this->template->render();
    }

    function add_form() {
        $this->template->write('title', 'Vendor | Tambah Lapangan', TRUE);
        $this->template->write_view('content', 'add_lapangan', $this->formData, TRUE);
        $this->template->render();
    }

    function add() {
        $this->load->library(array('form_validation'));
        $this->form_validation->set_rules('name', 'Nama Lapangan','trim|required');
        $this->form_validation->set_rules('rent_price', 'Harga sewa','trim|required');
        
        if($this->form_validation->run()===FALSE) {
			$this->session->set_flashdata('message', 'Tambah Lapangan Gagal');
            $this->template->write('title', 'Vendor | Tambah Lapangan', TRUE);
            $this->template->write_view('content', 'add_lapangan', $this->formData, TRUE);
            $this->template->render();
        } else {
            $name = $this->input->post('name');
            $rent_price = $this->input->post('rent_price');

            $this->load->model('vendor/Vendor_model', 'Vendor');

            $params = array(
                'name'=> $name,
                'rent_price'=> $rent_price,
                'vendor_id'=> $this->Vendor->getAll()[0]->id
            );

            $config = array(
                'upload_path' => "./media/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'file_ext_tolower' => TRUE,
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'file_name' =>  now()
            );

            $this->load->library('upload', $config);
            
            if ( !$this->upload->do_upload('image')){
                $this->session->set_flashdata('message', $this->upload->display_errors());
                $this->template->write('title', 'Vendor | Tambah Lapangan', TRUE);
                $this->template->write_view('content', 'add_lapangan', $this->formData, TRUE);
                $this->template->render();
            } else {
                $params['image'] = $this->upload->data()['file_name'];
            }


            $this->Hall->insert($params);
            redirect('vendor/data_lapangan');

        }
    }

}