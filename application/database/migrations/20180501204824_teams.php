<?php

class Migration_teams extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'auto_increment' => TRUE,
                'unsigned' => TRUE,
            ),
            'user_id' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE,
            ),
            'active' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'default' => 1
            ),
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'description' => array(
                'type' => 'TEXT'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('teams');
    }

    public function down() {
        $this->dbforge->drop_table('teams');
    }

}