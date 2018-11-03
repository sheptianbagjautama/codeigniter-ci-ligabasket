<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_lapangan extends MY_Controller {

    function __construct() {
        parent::__construct();
        $data = array('menuTitle' => 'Jadwal Lapangan', 'modulUrl'=> base_url('vendor'));
        $this->template->write_view('_scripts', 'script', $data, TRUE);
        $this->template->write_view('menu', 'menu', $data, TRUE);
    }

    function index() {
        $this->load->model('vendor/Hall_model', 'Hall');
        $this->load->model('vendor/Schedule_model', 'Schedule');
        $halls = $this->Hall->getAll();
        $schedules = $this->Schedule->getAll();

        $data = array(
            'menuTitle' => 'Kelola Jadwal Lapangan', 
            'halls' => $halls,
            'schedules' => $schedules
        );
        
        $this->template->write('title', 'Vendor | Kelola Jadwal Lapangan', TRUE);
        $this->template->write_view('content', 'kelola_jadwal_lapangan', $data, TRUE);
        $this->template->render();
    }


    function detail($hallId, $date) {

        $this->load->model('vendor/Hallschedule_model', 'HallSchedule');
        header('Content-Type: application/json');
        echo json_encode( $this->HallSchedule->get($hallId, $date));
    }

    function add() {
        $this->load->model('vendor/Hallschedule_model', 'HallSchedule');
        $hallId = $this->input->post('hallId');
        $halldate = $this->input->post('halldate');
        $schedules = $this->input->post('schedules');

        return $this->HallSchedule->bulkInsert($hallId, $halldate, $schedules);
    }

    
}