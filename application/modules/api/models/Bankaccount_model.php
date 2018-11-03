<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bankaccount_model extends CI_Model {
    public function findByUserId($userId) {
        return $this->db->get_where('bank_accounts', array('user_id' => $userId))->result()[0];
    }
}