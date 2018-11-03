<?php

class Bankaccount_model extends CI_Model {
    public $user_id;
    public $bank_name;
    public $account_no;
    public $account_name;
    public $created_on;

    public function insert($params){
        $this->bank_name    = $params['bank_name']; // please read the below note
        $this->account_no   = $params['account_no'];
        $this->account_name   = $params['account_name'];

        $this->user_id = $params['user_id'];
        $this->created_on = time();

        $this->db->insert('bank_accounts', $this);

        return ($this->db->affected_rows() > 0);
    }
}