<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {
    public $team_id;
    public $hall_id;
    public $hall_schedule_ids;
    public $customer;
    public $bank_account_name;
    public $bank_name;
    public $bank_account_number;
    public $order_date;

    public function insert($params) {
        $this->id = $params['id'];
        $this->team_id = $params['team_id'];
        $this->hall_id = $params['hall_id'];
        $this->hall_schedule_ids = $params['hall_schedule_ids'];
        $this->customer = $params['customer'];
        $this->bank_account_name = $params['bank_account_name'];
        $this->bank_name = $params['bank_name'];
        $this->bank_account_number = $params['bank_account_number'];
        $this->order_date = $params['order_date'];
        $this->rent_hour = $params['rent_hour'];
        $this->total_bill = $params['total_bill'];
        $this->bank_account_id = $params['bank_account_id'];

        $this->created_on = time();

        $this->db->insert('invoices', $this);

        return ($this->db->affected_rows() > 0);
    }

    public function findByTeamId($teamId, $invoiceId=NULL) {
        $mediaUrl = base_url();

        if( $invoiceId) {
            $this->db->select('v.id AS vendor_id, iv.id AS invoice_number, iv.total_bill, iv.customer, iv.rent_hour, iv.status, h.name AS hall_name, CONCAT("'.$mediaUrl.'media/", h.image) as hall_image_url, iv.order_date, iv.message, v.name AS location');
            $this->db->from('invoices AS iv');
            $this->db->join('halls AS h', 'h.id = iv.hall_id');
            $this->db->join('vendors AS v', 'v.id = h.vendor_id');
            $this->db->where(array('iv.id'=>$invoiceId));
            $response = $this->db->get()->result()[0];
        } else {
            $this->db->select('iv.total_bill, iv.id AS invoice_number, iv.customer, iv.rent_hour, iv.status, h.name AS hall_name, CONCAT("'.$mediaUrl.'media/", h.image) as hall_image_url');
            $this->db->from('invoices AS iv');
            $this->db->join('halls AS h', 'h.id = iv.hall_id');
            $this->db->where(array('iv.team_id'=>$teamId));
            $response = $this->db->get()->result();
        }

        return  $response;
    }

    public function confirm($invoiceId, $image) {
        if($image) {
            $this->db->set('receipt_of_transfer', $image);
        }
        $this->db->where('id', $invoiceId);
        return $this->db->update('invoices');
    }

    public function update($invoiceId, $data) {
        $this->db->set($data);
        $this->db->where('id', $invoiceId);
        $this->db->set('status', 'transfer');
        return $this->db->update('invoices');
    }
}