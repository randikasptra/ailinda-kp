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
                'jurusan' => 'SAINTEK',
                'poin'    => 10
            ],
            [
                'nisn'    => '0038217466',
                'nama'    => 'Dina Safitri',
                'kelas'   => 'XI IPS 2',
                'jurusan' => 'SOSHUM',
                'poin'    => 5
            ],
            [
                'nisn'    => '0038217467',
                'nama'    => 'Rafi Pratama',
                'kelas'   => 'X TKJ 1',
                'jurusan' => 'SAINTEK',
                'poin'    => 15
            ],
            [
                'nisn'    => '0038217123',
                'nama'    => 'Ahmad Putra',
                'kelas'   => 'XI IPS 2',
                'jurusan' => 'SOSHUM',
                'poin'    => 15
            ],
            // 🔁 Data duplikat nama (1)
            [
                'nisn'    => '0038217555',
                'nama'    => 'Ahmad Fauzi',
                'kelas'   => 'XII IPS 3',
                'jurusan' => 'SAINTEK',
                'poin'    => 7
            ],
            // 🔁 Data duplikat nama (2)
            [
                'nisn'    => '0038217999',
                'nama'    => 'Rafi Pratama',
                'kelas'   => 'XI IPA 2',
                'jurusan' => 'SOSHUM',
                'poin'    => 12
            ],
            // ✅ Data unik lainnya
            [
                'nisn'    => '0038217666',
                'nama'    => 'Nisa Khairunnisa',
                'kelas'   => 'XII Bahasa 1',
                'jurusan' => 'SOSHUM',
                'poin'    => 0
            ],
            [
                'nisn'    => '0038217777',
                'nama'    => 'M. Rizky Alfarizi',
                'kelas'   => 'X IPA 3',
                'jurusan' => 'SOSHUM',
                'poin'    => 2
            ],
            [
                'nisn'    => '0038217888',
                'nama'    => 'Siti Maesaroh',
                'kelas'   => 'XI Bahasa 2',
                'jurusan' => 'SOSHUM',
                'poin'    => 4
            ],
            [
                'nisn'    => '0038217333',
                'nama'    => 'Ahmad Fauzi',
                'kelas'   => 'X TKJ 2',
                'jurusan' => 'SOSHUM',
                'poin'    => 20
            ]
        ];

        $this->db->table('siswa')->insertBatch($data);
    }
}
