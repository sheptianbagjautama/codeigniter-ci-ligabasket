<?php

class Migration_add_status_to_match_histories extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('match_histories', array(
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => 'waiting'
            )
        ));
    }
}