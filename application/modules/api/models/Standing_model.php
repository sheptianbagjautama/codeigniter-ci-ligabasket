<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Standing_model extends CI_Model {

    public $team_id;



    public function insert($params) {

        $this->team_id = $params['team_id'];

        $this->db->insert('standings', $this);

        return ($this->db->affected_rows() > 0);

    }



    public function update($teamId, $rivalId, $matchResult) {

        $this->db->set('mp', 'mp+1', FALSE);

        $this->db->set($matchResult, $matchResult . '+1', FALSE);

        $this->db->set('pts', '((w*2) + (l*1))', FALSE);

        $this->db->set('ptc', '((w+wo)/mp)', FALSE);

        $this->db->where('team_id', $teamId);

        $this->db->update('standings');



        $matchResultRival = 'l';

        if($matchResult == 'wo') {

            $matchResultRival = 'lo';

        }



        $this->db->set('mp', 'mp+1', FALSE);

        $this->db->set($matchResultRival, $matchResultRival . '+1', FALSE);

        $this->db->set('pts', '((w*2) + (l*1))', FALSE);

        $this->db->set('ptc', '((w+wo)/mp)', FALSE);

        $this->db->where('team_id', $rivalId);

        $this->db->update('standings');



        return ($this->db->affected_rows() > 0);

    }



    public function all() {

		$mediaUrl = base_url();

        $this->db->select('standings.id, standings.mp, standings.w, standings.wo, standings.lo, standings.l, standings.pts, standings.ptc, teams.name, CONCAT("'.$mediaUrl.'media/", teams.image) AS image');

        $this->db->from('standings');

        $this->db->join('teams', 'teams.id = standings.team_id');

        $this->db->order_by('standings.pts', 'desc');

        $query = $this->db->get();

        return $query->result();

    }


    public function findByTeamNearby($teamName, $lat, $lng) {

        $mediaUrl = base_url();

        $this->db->select('standings.id, teams.id AS rival_id, standings.mp, standings.w, standings.wo, standings.lo, standings.l, standings.pts, standings.ptc, teams.name, CONCAT("'.$mediaUrl.'media/", teams.image) AS image');

        $this->db->from('standings');

        $this->db->join('teams', 'teams.id = standings.team_id');

        $this->db->like('teams.name', $teamName, 'both');

        $query = $this->db->get();

        return $query->result();

    }

    public function findByTeam($teamName) {

		$mediaUrl = base_url();

        $this->db->select('standings.id, teams.id AS rival_id, standings.mp, standings.w, standings.wo, standings.lo, standings.l, standings.pts, standings.ptc, teams.name, CONCAT("'.$mediaUrl.'media/", teams.image) AS image');

        $this->db->from('standings');

        $this->db->join('teams', 'teams.id = standings.team_id');

        $this->db->like('teams.name', $teamName, 'both');

        $query = $this->db->get();

        return $query->result();

    }



    public function findByTeamId($teamId) {

        $this->db->select('standings.id, standings.mp, standings.w, standings.wo, standings.lo, standings.l, standings.pts, standings.ptc, teams.name');

        $this->db->from('standings');

        $this->db->join('teams', 'teams.id = standings.team_id');

        $this->db->where('standings.team_id', $teamId);

        $query = $this->db->get();

        return $query->result()[0];

    }

}