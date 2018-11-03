<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Event extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array("menuTitle" => "Data Event", 'modulUrl'=> base_url('commite'));
        $this->template->write_view('_scripts', 'script_event', $data, TRUE);
        $this->template->write_view('menu', 'menu',$data, TRUE);
        $this->load->model('Event_model', 'Event');

        $this->formData = array(
            'menuTitle' => 'Add Event',
			'csrf' => array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			),
			'labelAttr' => array('class' => 'col-sm-4 col-form-label'),
            'inputAttr' => array('class' => 'form-control')
        );
    }

    function index() {
        $data = $this->Event->getAll();

        $status = array('archive', 'publish');

        $this->template->write('title', 'Commite | Event', TRUE);
        $this->template->write_view('content', 'event', array('data' => $data, 'status'=> $status), TRUE);
        $this->template->render();
    }

    function add_form() {
        $this->load->model('vendor/Vendor_model', 'Vendor');
        $vendors = $this->Vendor->all();
        $this->formData['vendorOptions'] = array('' => '--Pilih Lokasi--');

        $additionalData = array();
        foreach ($vendors as &$item) {
            $this->formData['vendorOptions'][strtolower($item['id'])] = $item['name'];
        }

        $this->template->write('title', 'Commite | Tambah Event', TRUE);
        $this->template->write_view('content', 'add_event', $this->formData, TRUE);
        $this->template->render();
    }

    function add() {
        $this->load->library(array('form_validation'));
        $this->form_validation->set_rules('name', 'Nama Event','trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi Event','trim|required');
        $this->form_validation->set_rules('event_date', 'Tanggal Event','trim|required');
        $this->form_validation->set_rules('price', 'Biaya Pendaftaran','trim|required');
        // $this->form_validation->set_rules('vendor', 'Lokasi','trim|required');
        
        if($this->form_validation->run()===FALSE) {
			$this->session->set_flashdata('message', 'Tambah Event Gagal');
            $this->template->write('title', 'Commite | Tambah Event', TRUE);
            $this->template->write_view('content', 'add_event', $this->formData, TRUE);
            $this->template->render();
        } else {
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $event_date_raw = $this->input->post('event_date');
            $event_date_arr = (explode("/", $event_date_raw));
            $event_date = $event_date_arr[2] . '-' . $event_date_arr[1] . '-' . $event_date_arr[0];

            $price = $this->input->post('price');
            $vendor = 1;
            // $vendor = $this->input->post('vendor');

            $lat = $this->input->post('lat');
            $lng = $this->input->post('lng');

            $params = array(
                'name'=> $name,
                'description'=>$description,
                'event_date'=>$event_date,
                'price'=> $price,
                'vendor_id'=> $vendor,
                'latitude'  => $lat,
                'longitude' => $lng,
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
                $this->template->write('title', 'Commite | Tambah Event', TRUE);
                $this->template->write_view('content', 'add_event', $this->formData, TRUE);
                $this->template->render();
            } else {
                $params['image'] = $this->upload->data()['file_name'];
            }

            if($this->Event->insert($params)) {
                redirect('commite/event');
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                $this->template->write('title', 'Commite | Tambah Event', TRUE);
                $this->template->write_view('content', 'add_event', $this->formData, TRUE);
                $this->template->render();
            }
            

        }
    }

    function publish($eventId) {


        $this->output->set_content_type('application/json');
        if($this->Event->publish($eventId)) {
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