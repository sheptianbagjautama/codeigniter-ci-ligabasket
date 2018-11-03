<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matchhistory_model extends CI_Model {
    public $team_id;
    public $rival_id;
    public $team_score;
    public $rival_score;
    public $created_on;

    public function insert($params) {
        // cari data dulu

        $this->team_id  = $params['team_id']; 
        $this->rival_id = $params['rival_id']; 
        $this->team_score  = $params['team_score']; 
        $this->rival_score = $params['rival_score']; 
        if(isset($params['match_date'])) {
            $this->match_date = $params['match_date'];
        } else {
            $this->match_date = NOW();
        }
       
        $this->created_on = time();


        $this->db->where("team_id", $this->team_id);
        $this->db->where("rival_id", $this->rival_id);
        $this->db->where("team_score", 0);
        $this->db->where("rival_score", 0);
        $this->db->where("match_date", $this->match_date);
        $get = $this->db->get("match_histories");

        if ($get->num_rows() > 0) {
            $get = $get->row();

            $this->db->set("team_score", $this->team_score);
            $this->db->set("rival_score", $this->rival_score);
            $this->db->where("id", $get->id);
            $this->db->update("match_histories");
        } else {
            // 10 -> example: 2018-01-03
            if (strlen($this->match_date) == 10) {
                $this->db->insert('match_histories', $this);
            }
        }


        return ($this->db->affected_rows() > 0);
    }

    public function all($teamId, $status=NULL) {
        $mediaUrl = base_url();
        $sql = 'SELECT rival.id,team.user_id,team.team_id, rival.rival_id AS rival_id, rival.match_date, 
team.team_name, rival.rival_name, 
team.team_score, team.rival_score,
CONCAT("'.$mediaUrl.'media/", team.image) AS team_image_url,  CONCAT("'.$mediaUrl.'media/", rival.image) AS rival_image_url FROM(
            SELECT mh.id, t.id AS rival_id, mh.team_score, mh.rival_score, t.name AS rival_name, 
                t.image, mh.match_date
            FROM match_histories AS mh
            JOIN teams AS t On t.id = mh.team_id 
            WHERE mh.team_id = ? OR mh.rival_id = ?
        ) AS rival
        JOIN (
            SELECT mh.id, mh.team_score, mh.rival_score,t.user_id, t.id as team_id, t.name AS team_name, t.image
            FROM match_histories AS mh
            JOIN teams AS t On t.id = mh.rival_id
            WHERE mh.team_id = ? OR mh.rival_id = ?
        ) AS team ON team.id = rival.id order by rival.id desc';
        

        $query =$this->db->query($sql, array($teamId, $teamId, $teamId, $teamId));
        return $query->result();
    }

    public function findScoreNotificationFromRival($teamId) {
        $mediaUrl = base_url();
        $this->db->select('mh.id, mh.status, mh.match_date,
                        mh.team_id as team_id, t.name AS team_name, 
                        mh.rival_id as rival_id, r.name AS rival_name, 
                        CAST(mh.team_score AS UNSIGNED) AS rival_score, 
                        CAST(mh.rival_score AS UNSIGNED) AS team_score, 

                        CONCAT("'.$mediaUrl.'media/", t.image) AS team_image_url, 
                        CONCAT("'.$mediaUrl.'media/", r.image) AS rival_image_url, 
                        (CASE WHEN CAST(mh.rival_score AS UNSIGNED) > CAST(mh.team_score AS UNSIGNED) THEN "win" WHEN CAST(mh.rival_score AS UNSIGNED) < CAST(mh.team_score AS UNSIGNED) THEN "lose" ELSE "draw" END) as match_result');
        $this->db->from('match_histories AS mh');
        $this->db->join('teams AS t', 't.id = mh.team_id');
        $this->db->join('teams AS r', 'r.id = mh.rival_id');
        $this->db->where(array('mh.rival_id'=>$teamId));
        $this->db->or_where(array('mh.team_id'=>$teamId));
        $this->db->order_by('id', 'DESC');
        $this->db->order_by('status', 'waiting');
        $query =  $this->db->get();

        return $query->result();
    }

    public function update($matchHistoryId, $params) {
        $this->db->set('status', '\''.$params['status'].'\'', FALSE);
        $this->db->where('id', $matchHistoryId);
        $this->db->update('match_histories');
        return ($this->db->affected_rows() > 0);
    }
}