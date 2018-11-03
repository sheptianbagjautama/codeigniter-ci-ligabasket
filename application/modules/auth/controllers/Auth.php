<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','language'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
		$this->template->set_template('login');
		
		$this->formData = array(
			'csrf' => array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			),
			'labelAttr' => array('class' => 'col-sm-4 col-form-label'),
			'inputAttr' => array('class' => 'form-control'),
			'bankOptions' => array(
				''    => '--Pilih Tipe Rekening--',
				'bca'  => 'BCA',
				'bni'  => 'BNI',
				'bri'  => 'BRI',
				'mandiri' => 'Mandiri',
			)
        );

        $this->data = [];
    }

    function index() {
        if (!$this->ion_auth->logged_in()) {
            $this->template->write('title', 'Login', TRUE);
            $this->template->write_view('content', 'login_form', '', TRUE);
            $this->template->render();
        } else {
            if ($this->ion_auth->is_admin()) {
                redirect('admin/home');
            } else if ($this->ion_auth->in_group('vendor')) {
                redirect('vendor/home');
            } else {
                redirect('commite/home');
            }
        }
        
	}
	
	function registration() {
		
		$this->template->write('title', 'Registration', TRUE);
		$this->template->write_view('content', 'registration_form', $this->formData, TRUE);
		$this->template->render();
	}

	function register() {
		$groupId  = $this->input->post('groupId');
		
		$this->form_validation->set_rules('name', 'Nama Lengkap','trim|required');
		$this->form_validation->set_rules('phone', 'Telepon','trim|is_unique[users.phone]|required');
        $this->form_validation->set_rules('email','Alamat Email','trim|valid_email|is_unique[users.email]|required');
        $this->form_validation->set_rules('password','Password','trim|min_length[8]|max_length[20]|required');

		if($groupId == 2) { // Tipe Vendor
			$this->form_validation->set_rules('bankAccount', 'Nomor Rekening','trim|is_unique[bank_accounts.account_no]');
			$this->form_validation->set_rules('vendorName', 'Nama tempat basket','trim|required');
			// $this->form_validation->set_rules('vendorAddress', 'Alamat tempat basket','trim|required');
		}

		if($this->form_validation->run()===FALSE) {
			$this->session->set_flashdata('message', 'Registrasi gagal 1!');
            redirect('auth/registration');
        } else {
			$name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
			$password = $this->input->post('password');
			$lat = $this->input->post('lat');
			$lng = $this->input->post('lng');
			$groups = array($groupId);
			
			$additional_data = array(
				'phone' => $phone,
				'name' => $name,
			);
			
			if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
				$additional_data = array_merge($additional_data, array('addedByAdmin' => 1));
			}

            $this->load->library('ion_auth');
            if($userId = $this->ion_auth->register('', $password, $email, $additional_data, $groups)) {
				$this->session->set_userdata('email', $email);
				$this->session->set_flashdata('message', 'Registrasi berhasil, silahkan login!');
				if($groupId == 2) { // Tipe Vendor
					$this->load->model('vendor/Vendor_model', 'vendor');
					$vendor = $this->input->post('vendorName');
					$vendorAddress = $this->input->post('vendorAddress');
	
					$bankName = $this->input->post('bankName');
					$bankAccount = $this->input->post('bankAccount');
					$accountName = $this->input->post('accountName');
	
					$vendorData = array(
						'user_id' => $userId,
						'name' => $vendor,
						'address' => $vendorAddress,	
						'latitude'	=> $lat,
						'longitude'	=> $lng,
					);
	
					if($this->vendor->insert($vendorData)) {
	
						if(isset($bankName) && isset($bankAccount) && isset($accountName)) {
							$bankAccountData = array(
								'user_id' => $userId,
								'bank_name' => $bankName,
								'account_no' => $bankAccount,
								'account_name' => $accountName
							);
	
							$this->load->model('vendor/Bankaccount_model', 'bankAccount');
							$this->bankAccount->insert($bankAccountData);
	
							redirect('auth');
						} else {
							redirect('auth');
						}
					} else {
						log_message('error', 'Insert Hall failed');
						$this->session->set_flashdata('message', 'Insert Lapangan gagal, silahkan login');
						redirect('auth');
					}
				} else {
					redirect('auth');
				}
				
            } else {
				log_message('error', 'Insert User Failed');
				$this->session->set_flashdata('message', 'Registrasi gagal 2!');
                redirect('auth/registration');
            }
		}
	}

    function login() {
		
		//validate form input
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == true)
		{
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                if ($this->ion_auth->is_admin()) {
                    redirect('admin/home');
                } else if ($this->ion_auth->in_group('vendor')) {
                    redirect('vendor/home');
                } else {
                    redirect('commite/home');
                }
			}
			else
			{
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);

            $this->template->write('title', 'Login', TRUE);
            $this->template->write_view('content', 'login_form', '', TRUE);
            $this->template->render();
        }
    }

    function logout() {
		//log the user out
		$this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth');
    }
}