<?php

class Migration_events extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'auto_increment' => TRUE,
                'unsigned' => TRUE
            ),
            'vendor_id' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'user_id' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'price' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'event_date' => array(
                'type' => 'DATE',
            ),
            'description' => array(
                'type' => 'TEXT',
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('events');
    }

    public function down() {
        $this->dbforge->drop_table('events');
    }

}