<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel siswa sebelum isi ulang
        $this->db->table('siswa')->truncate();

        $data = [
            [
                'nisn'    => '1000000001',
                'nama'    => 'Ahmad Fauzi',
                'kelas'   => '10',
                'jurusan' => 'SAINTEK',
                'poin'    => 5
            ],
            [
                'nisn'    => '1000000002',
                'nama'    => 'Dina Safitri',
                'kelas'   => '11',
                'jurusan' => 'SAINTEK',
                'poin'    => 10
            ],
            [
                'nisn'    => '1000000003',
                'nama'    => 'Rafi Pratama',
                'kelas'   => '12',
                'jurusan' => 'SAINTEK',
                'poin'    => 15
            ],
            [
                'nisn'    => '1000000004',
                'nama'    => 'Nisa Khairunnisa',
                'kelas'   => 'SOSHUM 1',
                'jurusan' => 'SOSHUM',
                'poin'    => 0
            ],
            [
                'nisn'    => '1000000005',
                'nama'    => 'M. Rizky Alfarizi',
                'kelas'   => 'SOSHUM 2',
                'jurusan' => 'SOSHUM',
                'poin'    => 4
            ],
            [
                'nisn'    => '1000000006',
                'nama'    => 'Siti Maesaroh',
                'kelas'   => 'SOSHUM 3',
                'jurusan' => 'SOSHUM',
                'poin'    => 7
            ],
            [
                'nisn'    => '1000000007',
                'nama'    => 'Ahmad Putra',
                'kelas'   => 'SOSHUM 4',
                'jurusan' => 'SOSHUM',
                'poin'    => 8
            ],
            [
                'nisn'    => '1000000008',
                'nama'    => 'Rina Wulandari',
                'kelas'   => 'SOSHUM 5',
                'jurusan' => 'SOSHUM',
                'poin'    => 2
            ],
            [
                'nisn'    => '1000000009',
                'nama'    => 'Bagas Prakoso',
                'kelas'   => '10',
                'jurusan' => 'SAINTEK',
                'poin'    => 1
            ],
            [
                'nisn'    => '1000000010',
                'nama'    => 'Lestari Dewi',
                'kelas'   => '11',
                'jurusan' => 'SAINTEK',
                'poin'    => 3
            ]
        ];

        $this->db->table('siswa')->insertBatch($data);
    }
}