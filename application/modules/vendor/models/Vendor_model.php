<?php

class Vendor_model extends CI_Model {
    public $name;
    public $user_id;
    public $address;
    public $latitude;
    public $longitude;

    public function insert($params){
        $this->name     = $params['name']; // please read the below note
        $this->address   = $params['address'];

        if (isset($params['latitude']) && isset($params['longitude'])) {
            $this->longitude = $params['longitude'];
            $this->latitude = $params['latitude'];
        }
        $this->user_id = $params['user_id'];

        $this->db->insert('vendors', $this);

        return ($this->db->affected_rows() > 0);
    }

    public function getAll() {
        if($this->ion_auth->is_admin()) {
            $query = $this->db->get('vendors');
        } else {
            $query = $this->db->get_where('vendors', array('user_id'=> $this->session->userdata('user_id')));
        }
        
        return $query->result();
    }

    public function all() {
        $query = $this->db->get('vendors');
        return $query->result_array();
    }

    public function count() {
        $query = $this->db->get('vendors');
        return count($query->result());
    }
}