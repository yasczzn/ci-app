<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        // $data = [
            
        //         'name'          => 'ade',
        //         'email'         => 'abuyadfashsd@gmail.com',
        //         'created_at'    => Time::now(),
        //         'updated_at'    => Time::now()
            
        // ];
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'name'          => $faker->name(),
                'email'         => $faker->email(),
                'created_at'    => Time::createFromTimestamp($faker->unixTime()),
                'updated_at'    => Time::now()
            ];
            $this->db->table('user')->insert($data);
        }

        // Simple Queries
        // $this->db->query('INSERT INTO user (name, email, created_at, updated_at) VALUES(:name:, :email:,
        //  :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('user')->insert($data);
        // $this->db->table('user')->insertBatch($data);
    }
}