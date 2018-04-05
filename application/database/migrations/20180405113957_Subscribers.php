<?php

class Migration_Subscribers extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'lastname' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'zip' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'state' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'company' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'email_address' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'state_of_origin' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'phone_number' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'date_created' => array(
                'type' => 'DATETIME'
            ),
            'created_by' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'updated_by' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'updated_at' => array(
                'type' => 'DATETIME'
            )

        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('subscribers');
    }

    public function down() {
        $this->dbforge->drop_table('subscribers');
    }

}