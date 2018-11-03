<?php

class Migration_schedules extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'range_time' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'active' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'default' => 1
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'default' => now()
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('schedules');
    }

    public function down() {
        $this->dbforge->drop_table('schedules');
    }

}