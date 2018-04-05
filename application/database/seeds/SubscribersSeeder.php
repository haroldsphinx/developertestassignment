<?php

class SubscribersSeeder extends Seeder
{
    private $table = 'subscribers';

    public function run()
    {
        $this->db->truncate($this->table);

        //seed records manually
        $data = [
            'email_address' => $this->faker->unique()->email,
            'name' => $this->faker->unique()->userName,
            'state' => 'active',
            'lastname' => $this->faker->unique()->lastName,
            'company' => $this->faker->unique()->company,
            'country' => 'Nigeria',
            'city' => 'Lagos',
            'zip' => '',
            'phone_number' => $this->faker->unique()->phoneNumber,
            'state_of_origin' => 'Lagos'
        ];
        $this->db->insert($this->table, $data);

        //seed many records using faker
        $limit = 33;
        echo "seeding $limit subscriber accounts";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";

            $data = array(
                'email_address' => $this->faker->unique()->email,
                'name' => $this->faker->unique()->userName,
                'state' => 'active',
                'lastname' => $this->faker->unique()->lastName,
                'company' => $this->faker->unique()->company,
                'country' => 'Nigeria',
                'city' => 'Lagos',
                'zip' => '',
                'phone_number' => $this->faker->unique()->phoneNumber,
                'state_of_origin' => 'Lagos'
            );

            $this->db->insert($this->table, $data);
        }

        echo PHP_EOL;
    }
}
