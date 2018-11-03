<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating_model extends CI_Model {
    public $rating_from;
    public $team_id;
    public $sportsmanship;
    public $teamwork;
    public $ability;
    public $dayatahan;
    public $strategi;
    public $keterampilan;
    public $kecepatan;

    public function insert($params) {
        $this->rating_from = $params['rating_from']; 
        $this->team_id = $params['team_id'];
        $this->sportsmanship = $params['sportsmanship'];
        $this->teamwork = $params['teamwork'];
        $this->ability = $params['ability'];
        $this->dayatahan = $params['dayatahan'];
        $this->strategi = $params['strategi'];
        $this->keterampilan = $params['keterampilan'];
        $this->kecepatan = $params['kecepatan'];

        $this->created_on = time();

        $this->db->insert('ratings', $this);

        return ($this->db->affected_rows() > 0);
    }

    public function getDataAvg($teamId) {
        $this->db->select("
            AVG(sportsmanship) AS sportsmanship, 
            AVG(teamwork) AS teamwork, 
            AVG(ability) AS ability,
            AVG(dayatahan) AS dayatahan,
            AVG(strategi) AS strategi,
            AVG(keterampilan) AS keterampilan,
            AVG(kecepatan) AS kecepatan

            ");
        $this->db->from('ratings');
        $this->db->where('team_id', $teamId);
        $query = $this->db->get();
        $rating = $query->result_array()[0];
        return $rating;
    }

    public function findByTeamId($teamId) {
        $maxRateValue = 5;

        $this->db->select("
            AVG(sportsmanship) AS sportsmanship, 
            AVG(teamwork) AS teamwork, 
            AVG(ability) AS ability,
            AVG(dayatahan) AS dayatahan,
            AVG(strategi) AS strategi,
            AVG(keterampilan) AS keterampilan,
            AVG(kecepatan) AS kecepatan

            ");
        $this->db->from('ratings');
        $this->db->where('team_id', $teamId);
        $query = $this->db->get();
        $rating = $query->result_array()[0];
        $ratePercentage = array(
            'sportsmanship' => ($rating['sportsmanship']/$maxRateValue) * 100,
            'teamwork' => ($rating['teamwork']/$maxRateValue) * 100,
            'ability' => ($rating['ability']/$maxRateValue) * 100,
            'dayatahan' => ($rating['dayatahan']/$maxRateValue) * 100,
            'strategi' => ($rating['strategi']/$maxRateValue) * 100,
            'keterampilan' => ($rating['keterampilan']/$maxRateValue) * 100,
            'kecepatan' => ($rating['kecepatan']/$maxRateValue) * 100,
        );

        return $ratePercentage;
    }

    public function getAll() {
        $this->db->select("ratings.*, teams.name, teams.image");
        $this->db->join('teams','teams.id = ratings.team_id');
        $data = $this->db->get('ratings')->result();
        return $data;
    }
}