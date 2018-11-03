<?php

class Migration_add_address_to_teams extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('teams', array(
            'address' => array(
                'type' => 'TEXT'
            )
        ));
    }
}