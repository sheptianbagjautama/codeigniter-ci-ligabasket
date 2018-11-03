<?php

class User_model extends CI_Model {
   
    public function getAll($groupName){
        $this->db->select('users.name AS name, users.email AS email, users.phone AS phone');
        $this->db->from('users');
        $this->db->join('groups', 'groups.name = \''.$groupName.'\'');
        $this->db->join('users_groups', 'users_groups.group_id = groups.id AND users_groups.user_id = users.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function count($userType=NULL) {
        $this->db->select('u.id');
        $this->db->from('users AS u');
        $this->db->join('users_groups AS ug', 'u.id = ug.user_id');
        $this->db->where('ug.group_id', $userType);
        $query = $this->db->get();
        return count($query->result());
    }
}