<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Hall_model extends CI_Model {



    public function all(){

        $mediaUrl = base_url();

        $this->db->select('halls.id, vendors.name AS vendor, halls.name, halls.rent_price, CONCAT("'.$mediaUrl.'media/", halls.image) as image_url, halls.latitude, halls.longitude');

        $this->db->from('halls');

        $this->db->join('vendors', 'vendors.id = halls.vendor_id');       

        $this->db->order_by('halls.created_on', 'desc'); 

        $query = $this->db->get();

        

        return $query->result();

    }



    public function findByVendorId($vendorId) {

        $this->db->select('*');

        $this->db->from('halls');   

        $this->db->where('vendor_id', $vendorId);

        $this->db->order_by('name', 'asc'); 

        $query = $this->db->get();

        

        return $query->result();

    }



    public function detail($id) {

        return $this->db->get_where('halls', array('id' => $id))->result()[0];

    }



}