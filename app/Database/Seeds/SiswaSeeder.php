<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        // Bersihin isi tabel dulu (reset data)
        $this->db->table('siswa')->truncate();

        $data = [
            [
                'nisn'    => '0038217465',
                'nama'    => 'Ahmad Fauzi',
                'kelas'   => 'XII IPA 1',
                'jurusan' => 'IPA',
                'poin'    => 10
            ],
            [
                'nisn'    => '0038217466',
                'nama'    => 'Dina Safitri',
                'kelas'   => 'XI IPS 2',
                'jurusan' => 'IPS',
                'poin'    => 5
            ],
            [
                'nisn'    => '0038217467',
                'nama'    => 'Rafi Pratama',
                'kelas'   => 'X TKJ 1',
                'jurusan' => 'IPA',
                'poin'    => 15
            ],
            [
                'nisn'    => '0038217123',
                'nama'    => 'Ahmad Putra',
                'kelas'   => 'XI IPS 2',
                'jurusan' => 'IPS',
                'poin'    => 15
            ]
        ];

        $this->db->table('siswa')->insertBatch($data);
    }
}
