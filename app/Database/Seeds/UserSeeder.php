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
                'password' => password_hash('piket123', PASSWORD_DEFAULT),
                'role'     => 'piket'
            ],
            [
                'username' => 'bp1',
                'password' => password_hash('bp123', PASSWORD_DEFAULT),
                'role'     => 'bp'
            ],
            [
                'username' => 'admin1',
                'password' => password_hash('admin1', PASSWORD_DEFAULT),
                'role'     => 'admin'
            ],
            [
                'username' => 'ailinda',
                'password' => password_hash('ailinda123', PASSWORD_DEFAULT),
                'role'     => 'admin'
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
