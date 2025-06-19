<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'piket1',
                'email'    => 'piket1@gmail.com',
                'password' => password_hash('piket123', PASSWORD_DEFAULT),
                'role'     => 'piket',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'bp1',
                'email'    => 'bp1@gmail.com',
                'password' => password_hash('bp123', PASSWORD_DEFAULT),
                'role'     => 'bp',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'admin1',
                'email'    => 'admin1@gmail.com',
                'password' => password_hash('admin1', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'ailinda',
                'email'    => 'ailinda@gmail.com',
                'password' => password_hash('ailinda123', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}