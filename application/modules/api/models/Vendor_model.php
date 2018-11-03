<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model {

    public function all(){
        $mediaUrl = base_url();
        $this->db->select('ba.bank_name, ba.account_no AS bank_account_number, ba.account_name AS bank_account_name, v.id, v.name, u.phone, v.address, v.latitude, v.longitude, CONCAT("'.$mediaUrl.'media/", h.image) AS image');
        $this->db->from('vendors As v');  
        $this->db->join('halls AS h', 'h.vendor_id = v.id');   
        $this->db->join('users AS u', 'u.id = v.user_id'); 
        $this->db->join('bank_accounts AS ba', 'ba.user_id = u.id');   
        $this->db->order_by('name', 'asc'); 
        $this->db->group_by('v.id');
        $query = $this->db->get();
        
        return $query->result();
    }

    public function detail($id) {
        return $this->db->get_where('vendors', array('id' => $id))->result()[0];
    }
    
}