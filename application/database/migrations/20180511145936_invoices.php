<?php

class Migration_invoices extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'varchar',
                'constraint' => '5',
                'unique' => TRUE
            ),
            'team_id' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'hall_id' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'bank_account_id' => array(
                'type' => 'INT',
                'unsigned' => TRUE
            ),
            'hall_schedule_ids' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => 'order'
            ),
            'customer' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'rent_hour' => array(
                'type' => 'TINYINT',
                'constraint' => '2',
                'unsigned' => TRUE,
            ),
            'message' => array(
                'type' => 'TEXT',
            ),
            'receipt_of_transfer' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'order_date' => array(
                'type' => 'DATE',
            ),
            'bank_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'bank_account_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'bank_account_number' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'total_bill' => array(
                'type' => 'MEDIUMINT',
                'unsigned' => TRUE
            ),
            'confirm_datetime' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'created_on' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('invoices');
    }

    public function down() {
        $this->dbforge->drop_table('invoices');
    }

}