<?php

class Migration_add_price_image_to_halls extends CI_Migration {
    public function up() {
        $this->dbforge->add_column('halls', array(
            'rent_price' => array(
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
            )
        ));
    }

}