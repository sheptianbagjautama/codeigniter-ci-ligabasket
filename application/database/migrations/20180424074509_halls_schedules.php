<?php

class Migration_halls_schedules extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'hall_id' => array(
                'type' => 'INT'
            ),
            'schedule_id' => array(
                'type' => 'INT'
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'default' => now()
            ),
            'active' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'default' => 1
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('halls_schedules');
    }

    public function down() {
        $this->dbforge->drop_table('halls_schedules');
    }

}