<?php

class Schedule_model extends CI_Model {
    public function getAll() {
        return $this->db->get('schedules')->result();
    }
}