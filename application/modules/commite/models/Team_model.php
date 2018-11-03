<?php

class Team_model extends CI_Model {
   
    public function getAll(){
        $mediaUrl = base_url();

        $this->db->select('t.name, t.address, t.description, u.phone, u.email, CONCAT("'.$mediaUrl.'media/", t.image) as image');
        $this->db->from('teams AS t');
        $this->db->join('users AS u', 'u.id = t.user_id');
        $query = $this->db->get();
        return $query->result();
    }

    

    public function count() {
        $query = $this->db->get('teams');
        return count($query->result_array());
    }
}