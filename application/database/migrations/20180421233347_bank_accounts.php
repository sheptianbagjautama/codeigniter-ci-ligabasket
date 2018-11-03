<?php

class Migration_bank_accounts extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT'
            ),
            'bank_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
            'account_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => TRUE,
            ),
            'account_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('bank_accounts');
    }

    public function down() {
        $this->dbforge->drop_table('bank_accounts');
    }

}