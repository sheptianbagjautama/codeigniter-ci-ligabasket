<?php

class Migration_halls extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT'
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'address' => array(
                'type' => 'TEXT',
            ),
            'latitude' => array(
                'type' => 'DECIMAL',
                'null' => TRUE
            ),
            'longitude' => array(
                'type' => 'DECIMAL',
                'null' => TRUE
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('halls');
    }

    public function down() {
        $this->dbforge->drop_table('halls');
    }

}