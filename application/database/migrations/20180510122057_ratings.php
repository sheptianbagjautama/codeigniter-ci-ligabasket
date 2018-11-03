<?php

class Migration_ratings extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'auto_increment' => TRUE,
                'unsigned' => TRUE
            ),
            'rating_from' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'team_id' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'sportsmanship' => array(
                'type' => 'TINYINT',
                'unsigned' => TRUE,
                'constraint' => '5'
            ),
            'teamwork' => array(
                'type' => 'TINYINT',
                'unsigned' => TRUE,
                'constraint' => '5'
            ),
            'ability' => array(
                'type' => 'TINYINT',
                'unsigned' => TRUE,
                'constraint' => '5'
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('ratings');
    }

    public function down() {
        $this->dbforge->drop_table('ratings');
    }

}