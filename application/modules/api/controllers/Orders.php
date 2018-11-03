<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

require_once(APPPATH.'modules/api/controllers/Rest.php');



class Orders extends Rest {

    public function __construct() {

        parent::__construct();

        $this->load->model('Invoice_model');

        $this->load->model('Team_model');

        $this->load->model('Hall_model');

        $this->load->model('Vendor_model');

        $this->load->model('Bankaccount_model');

        $this->cekToken();

    }

    

    public function index_post(){

        $this->load->helper('string');



        $userId = $this->getUserIdFromToken();

        $teamId = $this->Team_model->getTeamIdFrom($userId);

        



        $hallId = $this->post("hall_id");

        $hall = $this->Hall_model->detail($hallId);

        $randomInvoiceNumber = strtoupper(random_string('alnum', 5));

        $rentHour = count($this->post("hall_schedule_ids"));

        $hallPrice = $hall->rent_price;

        $totalBill = $rentHour * $hallPrice;



        $userIdVendor = $this->Vendor_model->detail($hall->vendor_id)->user_id;

        $vendorBankAccountId = $this->Bankaccount_model->findByUserId($userIdVendor)->id;





        $params = array(

            "id" => $randomInvoiceNumber,

            "team_id" => $teamId,

            "hall_id" => $hallId,

            "hall_schedule_ids" => $this->post("hall_schedule_ids"),

            "customer" => $this->post("customer"),

            "bank_account_name" => $this->post("bank_account_name"),

            "bank_name" => $this->post("bank_name"),

            "bank_account_number" => $this->post("bank_account_number"),

            "order_date" => $this->post("order_date"),

            "rent_hour" => $rentHour,

            "total_bill" => $totalBill,

            "bank_account_id" => $vendorBankAccountId,

            "hall_schedule_ids" => $this->post("hall_schedule_ids"),

        );



        if($this->Invoice_model->insert($params) ) {

            $this->set_response('success', REST_Controller::HTTP_OK);

        } else {

            $this->set_response('failed', REST_Controller::HTTP_BAD_REQUEST);

        }

    } 





    public function index_get($invoiceNumber=NULL){

        $userId = $this->getUserIdFromToken();

        $teamId = $this->Team_model->getTeamIdFrom($userId);

        if($invoiceNumber) {

            $this->response($this->Invoice_model->findByTeamId($teamId, $invoiceNumber));

        } else {

            $this->response($this->Invoice_model->findByTeamId($teamId));

        }

    }



    public function confirmation_post($invoiceNumber) {

        //  $config = array(

        //     'upload_path' => "./media/",

        //     'allowed_types' => "gif|jpg|png|jpeg|pdf",

        //     'file_ext_tolower' => TRUE,

        //     'overwrite' => TRUE,

        //     'max_size' => "2048000",

        //     'file_name' =>  now()

        // );



        // $this->load->library('upload', $config);





        // $image = NULL;

        // if ($this->upload->do_upload('image')){

        //     $image = $this->upload->data()['file_name'];

        // }



        $data = [

            'bank_name'             => $this->post("bank_name"),

            'bank_account_name'     => $this->post("account_name"),

            'bank_account_number'   => $this->post("account_number"),

            'receipt_of_transfer'   => $this->post("bank_name"),

            'pic_latitude'          => $this->post("latitude"),

            'pic_longitude'         => $this->post("longitude"),

            'image_raw'         => $this->post("image_raw"),

        ];

        $data['image_raw'] = base64_decode($data['image_raw']);

        if($this->Invoice_model->update($invoiceNumber, $data)) {

            $this->set_response('success', REST_Controller::HTTP_OK);

        } else {

            $this->set_response('failed', REST_Controller::HTTP_BAD_REQUEST);

        }

    }

}