<?php

class Migration_vendors extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'user_id' => array(
                'type' => 'INT'
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
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('vendors');

        $this->dbforge->drop_column('halls', 'address');
        $this->dbforge->drop_column('halls', 'latitude');
        $this->dbforge->drop_column('halls', 'longitude');

        $this->dbforge->modify_column('halls', array(
            'user_id' => array(
                    'name' => 'vendor_id',
                    'type' => 'INT',
            ))
        );
    }

    public function down() {
        $this->dbforge->drop_table('vendors');
    }

}