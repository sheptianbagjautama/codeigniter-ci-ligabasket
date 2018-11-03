<?php

class Migration_broadcasts extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'auto_increment' => TRUE
            ),
            'team_id' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'message' => array(
                'type' => 'TEXT',
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('broadcasts');
    }

    public function down() {
        $this->dbforge->drop_table('broadcasts');
    }

}