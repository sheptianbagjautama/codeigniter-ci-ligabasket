<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matchinvitation_model extends CI_Model {
    public $team_id;
    public $rival_id;
    public $hall_id;
    public $match_date;
    public $created_on;

    public function insert($params) {
        $this->team_id  = $params['team_id']; 
        $this->rival_id = $params['rival_id']; 
        $this->hall_id = $params['hall_id'];
        $this->match_date = $params['match_date'];

        if(isset($params['message'])) {
            $this->message  = $params['message'];
        }

        if(isset($params['contact_number'])) {
            $this->contact_number = $params['contact_number'];
        }

        $this->created_on = time();

        $id = $this->db->insert('match_invitations', $this);

        

        return ($id > 0);
    }

    public function all($teamId) {
        $mediaUrl = base_url();
        $sql = 'SELECT team.id, team.team_id, team.rival_id, team.team_name, rival.rival_name, team.message, team.match_date, team.status, CONCAT("'.$mediaUrl.'media/", rival.image) AS image FROM(
            SELECT mi.id, mi.team_id, mi.rival_id, t.name AS team_name, mi.message, mi.match_date, mi.status, t.image
            FROM match_invitations AS mi
            JOIN teams AS t On t.id = mi.team_id 
            WHERE mi.team_id = ?
        ) AS team
        JOIN (
            SELECT mi.id, mi.team_id, mi.rival_id, t.name AS rival_name, mi.message, mi.match_date, mi.status, t.image
            FROM match_invitations AS mi
            JOIN teams AS t On t.id = mi.rival_id 
            WHERE mi.team_id = ?
        ) AS rival ON team.id = rival.id';

        $query =$this->db->query($sql, array($teamId, $teamId));
        return $query->result();
    }

    public function getAllRequest($teamId) {
        $mediaUrl = base_url();
        $sql = 'SELECT team.id, team.team_id, team.rival_id, team.team_name, rival.rival_name, team.message, team.match_date, team.status, CONCAT("'.$mediaUrl.'media/", rival.image) AS image FROM(
            SELECT mi.id, mi.team_id, mi.rival_id, t.name AS team_name, mi.message, mi.match_date, mi.status, t.image
            FROM match_invitations AS mi
            JOIN teams AS t On t.id = mi.team_id 
            WHERE mi.rival_id = ?
        ) AS team
        JOIN (
            SELECT mi.id, mi.team_id, mi.rival_id, t.name AS rival_name, mi.message, mi.match_date, mi.status, t.image
            FROM match_invitations AS mi
            JOIN teams AS t On t.id = mi.rival_id 
            WHERE mi.rival_id = ?
        ) AS rival ON team.id = rival.id';

        $query =$this->db->query($sql, array($teamId, $teamId));
        return $query->result();
    }

    public function allReverse($teamId, $invitationId=NULL) {
        $mediaUrl = base_url();
        if(isset($invitationId)) {
            $this->db->select('mi.id, tm.name as rival_name, vd.name AS vendor_name, hl.name as hall_name,  mi.match_date, mi.message, mi.contact_number,  CONCAT("'.$mediaUrl.'media/", tm.image) AS image');
            $this->db->from('match_invitations AS mi');
            $this->db->join('teams AS tm', 'tm.id = mi.rival_id'); 
            $this->db->join('halls AS hl', 'hl.id = mi.hall_id'); 
            $this->db->join('vendors AS vd', 'vd.id = hl.vendor_id');
            $this->db->where('mi.id', $invitationId);
            $query = $this->db->get();
            if(count($query->result_array()) > 0) {
                return $query->result_array()[0];
            } else {
                return false;
            }
        
        } else {
            $sql = 'SELECT team.id, team.team_id AS rival_id, team.team_name AS rival_name, team.message, team.match_date, team.status, CONCAT("'.$mediaUrl.'media/", team.image) AS image FROM(
                SELECT mi.id, mi.team_id, mi.rival_id, t.name AS team_name, mi.message, mi.match_date, mi.status, t.image
                FROM match_invitations AS mi
                JOIN teams AS t On t.id = mi.team_id 
                WHERE mi.rival_id = ? 
            ) AS team
            JOIN (
                SELECT mi.id, mi.team_id, mi.rival_id, t.name AS rival_name, mi.message, mi.match_date, mi.status, t.image
                FROM match_invitations AS mi
                JOIN teams AS t On t.id = mi.rival_id 
                WHERE mi.rival_id = ? 
            ) AS rival ON team.id = rival.id';
    
            $query =$this->db->query($sql, array($teamId, $teamId));
            return $query->result_array();
        }
    }

    public function update($invitationId, $params) {
        if ($params['status'] == "accept") {
            $this->load->model("Matchhistory_model");

            $this->db->where('id', $invitationId);
            $row_invitation = $this->db->get("match_invitations")->row();

            $insert = array(
                'team_id' => $row_invitation->team_id,
                'rival_id' => $row_invitation->rival_id,
                'team_score' => 0,
                'rival_score' => 0,
                'match_date' => $row_invitation->match_date,
            );

            $this->Matchhistory_model->insert($insert);
        }
        $this->db->set('status', $params['status']);
        $this->db->where('id', $invitationId);
        $this->db->update('match_invitations');
        return ($this->db->affected_rows() > 0);
    }


}