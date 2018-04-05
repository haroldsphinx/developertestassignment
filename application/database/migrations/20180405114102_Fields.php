<?php

class Migration_Fields extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            )
        ));
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('fields');
    }

    public function down()
    {
        $this->dbforge->drop_table('fields');
    }
}
