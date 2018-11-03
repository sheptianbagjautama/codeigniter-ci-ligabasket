<?php

class Migration_add_contact_person_to_match_invitation extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('match_invitations', array(
            'contact_number' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            )
        ));
    }

}