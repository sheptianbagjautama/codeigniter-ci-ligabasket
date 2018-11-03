<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {
    public $name;
    public $created_on;
    public $active;

    public function insert($params) {
        $this->name     = $params['name']; 
        if(isset($params['description'])) {
            $this->description   = $params['description'];
        }
        
        if (isset($params['image'])) {
            $this->image = $params['image'];
        }

        if (isset($params['address'])) {
            $this->address = $params['address'];
        }

        $this->user_id = $params['user_id'];
        $this->created_on = time();
        $this->active = true;

        $this->db->insert('teams', $this);

        return $this->db->insert_id();
    }

    public function getTeamFrom($userId) {
        $mediaUrl = base_url();
        $this->db->select('t.id, t.name, t.description, u.phone, u.email, t.address,  CONCAT("'.$mediaUrl.'media/", t.image) as image_url');
        $this->db->from('teams AS t');
        $this->db->join('users AS u', 'u.id = t.user_id');
        $this->db->where('user_id', $userId);

        return $this->db->get()->result()[0];
    }

    public function getTeamIdFrom($userId) {
        return  $this->getTeamFrom($userId)->id;
    }

    public function detail($teamId) {
        $this->db->select('t.id, t.name, t.description, u.phone, u.email, t.address');
        $this->db->from('teams AS t');
        $this->db->where('t.id', $teamId);
        $this->db->join('users AS u', 'u.id = t.user_id');
        $query =  $this->db->get();
        return  $query->result_array()[0];
    }

    public function getRecomendedTeam($teamId) {
        $this->db->select('t.id, t.name, r.sportsmanship, r.teamwork, r.ability');
        $this->db->from('teams AS t');
        $this->db->where('t.id <> '.$teamId);
        $this->db->join('ratings AS r', 'r.team_id = t.id');
        $query = $this->db->get();
        return  $query->result();
    }

    public function getAll() {
        $data = $this->db->get('teams')->result();
        return $data;
    }

    public function getAllWithoutTeamId($teamId) {
        $this->db->where('id <>', $teamId);
        $data = $this->db->get('teams')->result();
        return $data;
    }
    
}