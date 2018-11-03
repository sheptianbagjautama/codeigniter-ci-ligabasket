<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('commite/Event_model', 'Event');
        $this->load->model('commite/Standing_model', 'Standing');
        $this->load->model('commite/Team_model', 'Team');

        $data = array("menuTitle" => "Home", 'modulUrl'=> base_url('commite'));
        $this->template->write_view('menu', 'menu', $data, TRUE);
    }

    function index() {
        $data = array(
            'eventsCount'=> $this->Event->count(),
            'standingsCount'=> $this->Standing->count(),
            'teamsCount'=> $this->Team->count(),
        );

        $this->template->write('title', 'Commite | Home', TRUE);
        $this->template->write_view('content', 'home', $data, TRUE);
        $this->template->render();
    }
}