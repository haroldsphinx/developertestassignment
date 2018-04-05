<?php

class FieldsSeeder extends Seeder {

    private $table = 'fields';

    public function run() {
        $this->db->truncate($this->table);

        //seed records manually
        $data = [
            'title' => 'Payment_plan',
            'type' => 'varchar'
            
        ];
        $this->db->insert($this->table, $data);

        //seed many records using faker
        $limit = 2;
        echo "seeding $limit fields accounts";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";

            $data = array(
                'title' => 'Payment_plan',
                'type' => 'varchar'
            );

            $this->db->insert($this->table, $data);
        }

        echo PHP_EOL;
    }
}
