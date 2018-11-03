<?php

class Migration_add_status_to_event extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('events', array(
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => 'archive'
            )
        ));
    }

}