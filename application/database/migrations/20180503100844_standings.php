<?php

class Migration_standings extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'auto_increment' => TRUE,
                'unsigned' => TRUE,
            ),
            'team_id' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'mp' => array(
                'type' => 'INT',
                'default' => 0
            ),
            'w' => array(
                'type' => 'INT',
                'default' => 0
            ),
            'wo' => array(
                'type' => 'INT',
                'default' => 0
            ),
            'mp' => array(
                'type' => 'INT',
                'default' => 0
            ),
            'lo' => array(
                'type' => 'INT',
                'default' => 0
            ),
            'l' => array(
                'type' => 'INT',
                'default' => 0
            ),
            'pts' => array(
                'type' => 'FLOAT',
                'default' => 0.0
            ),
            'ptc' => array(
                'type' => 'FLOAT',
                'default' => 0.0
            ),
            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('standings');
    }

    public function down() {
        $this->dbforge->drop_table('standings');
    }

}