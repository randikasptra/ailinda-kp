<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'Piket',
                'email'    => 'piket@gmail.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'piket',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'Bagian Siswa',
                'email'    => 'bp@gmail.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'bp',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'ailinda',
                'email'    => 'ailinda@gmail.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}