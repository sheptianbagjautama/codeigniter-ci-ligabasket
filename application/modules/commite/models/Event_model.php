<?php

class Event_model extends CI_Model {
    public $user_id;
    public $vendor_id;
    public $event_date;
    public $name;
    public $price;
    public $image;
    public $description;

    public function insert($params) {
        $this->user_id = $this->session->userdata('user_id');
        $this->name  = $params['name']; 
        $this->price = $params['price'];
        $this->description = $params['description'];
        $this->vendor_id = $params['vendor_id'];
        $this->event_date = $params['event_date'];
        $this->latitude = $params['latitude'];
        $this->longitude = $params['longitude'];

        if (isset($params['image'])) {
            $this->image = $params['image'];
        }

        $this->created_on = time();


        $this->db->insert('events', $this);
        // $q = $this->db->last_query();
        // echo $q;exit;

        return ($this->db->affected_rows() > 0);
    }
    
    public function getAll() {
        $userId = $this->session->userdata('user_id');
        $mediaUrl = base_url();

        $this->db->select('e.id, e.name, e.price, e.event_date, e.description, u.phone, v.name AS vendor, v.address, e.status, CONCAT("'.$mediaUrl.'media/", e.image) as image');
        $this->db->from('events AS e');
        $this->db->join('vendors AS v', 'v.id = e.vendor_id');
        $this->db->join('users AS u', 'u.id = e.user_id');
        $this->db->where('u.id', $userId);
        $this->db->order_by('status', 'ASC');
        $this->db->order_by('event_date', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function count() {
        $userId = $this->session->userdata('user_id');
        $query = $this->db->get_where('events', array('user_id'=> $userId));
        return count($query->result_array());
    }

    public function publish($eventId) {
        $data = array('status' => 'published');
        $this->db->where('id', $eventId);
        return $this->db->update('events', $data);
    }

}