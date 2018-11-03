<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Broadcast_model extends CI_Model {
    public $team_id;
    public $message;
    public $created_on;

    public function insert($params) {
        $this->team_id     = $params['team_id']; 
        $this->message  = $params['message'];
        $this->created_on = time();

        $this->db->insert('broadcasts', $this);

        return ($this->db->affected_rows() > 0);
    }

    public function all($teamId) {
        $mediaUrl = base_url();
        $this->db->select('broadcasts.id, broadcasts.team_id, teams.name as team_name, CONCAT("'.$mediaUrl.'media/", teams.image) as team_image_url, broadcasts.message, broadcasts.created_on');
        $this->db->from('broadcasts');
        $this->db->where_not_in('team_id', array($teamId));
        $this->db->join('teams', 'teams.id = broadcasts.team_id');
        $this->db->order_by('broadcasts.created_on', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}