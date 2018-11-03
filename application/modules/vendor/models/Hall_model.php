<?php

class Hall_model extends CI_Model {
    public $vendor_id;
    public $name;
    public $rent_price;
    public $image;
    public $created_on;
    public $active;

    public function insert($params) {
        $this->name     = $params['name']; 
        $this->rent_price   = $params['rent_price'];

        if (isset($params['image'])) {
            $this->image = $params['image'];
        }
        $this->vendor_id = $params['vendor_id'];
        $this->created_on = time();
        $this->active = true;

        $this->db->insert('halls', $this);

        return ($this->db->affected_rows() > 0);
    }

    public function getAll(){
        $this->load->model('vendor/Vendor_model', 'Vendor');

        if($this->ion_auth->is_admin()) {
            $query = $this->db->get('halls');
        } else {
            $vendorId = $this->Vendor->getAll()[0]->id;
            $query = $this->db->get_where('halls', array('vendor_id'=> $vendorId));
        }
        
        return $query->result();
    }

    public function count() {
        $this->load->model('vendor/Vendor_model', 'Vendor');
        $vendorId = $this->Vendor->getAll()[0]->id;
        $query = $this->db->get_where('halls', array('vendor_id'=> $vendorId));
        return count($query->result_array());
    }
}