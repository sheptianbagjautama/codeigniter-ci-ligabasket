<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        
        if (!$this->input->is_cli_request()) {
            if($this->uri->segment(1) !== 'auth' && $this->uri->segment(1) !== 'api') {
                if (!$this->ion_auth->logged_in()) {
                   redirect('auth/',  'refresh');
                }
            }
            
            if($this->uri->segment(1) === 'admin' && !$this->ion_auth->is_admin() ) {
                redirect($this->agent->referrer(),  'refresh');
            }
        }
        
    }
}