<?php

class Standing_model extends CI_Model {
    
    public function getAll() {
        $this->db->select('t.name AS team, s.mp, s.w, s.wo, s.lo, s.l, s.pts, s.ptc');
        $this->db->from('standings AS s');
        $this->db->join('teams AS t', 't.id = s.team_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function count() {
        $query = $this->db->get('standings');
        return count($query->result_array());
    }
}