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
                'nisn'          => '1000000001',
                'nama'          => 'Ahmad Fauzi',
                'kelas'         => 10,
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 5
            ],
            [
                'nisn'          => '1000000002',
                'nama'          => 'Dina Safitri',
                'kelas'         => 11,
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 10
            ],
            [
                'nisn'          => '1000000003',
                'nama'          => 'Rafi Pratama',
                'kelas'         => 12,
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 15
            ],
            [
                'nisn'          => '1000000004',
                'nama'          => 'Nisa Khairunnisa',
                'kelas'         => 10,
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 0
            ],
            [
                'nisn'          => '1000000005',
                'nama'          => 'M. Rizky Alfarizi',
                'kelas'         => 10,
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 4
            ],
            [
                'nisn'          => '1000000006',
                'nama'          => 'Siti Maesaroh',
                'kelas'         => 11,
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 7
            ],
            [
                'nisn'          => '1000000007',
                'nama'          => 'Ahmad Putra',
                'kelas'         => 11,
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 8
            ],
            [
                'nisn'          => '1000000008',
                'nama'          => 'Rina Wulandari',
                'kelas'         => 12,
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 2
            ],
            [
                'nisn'          => '1000000009',
                'nama'          => 'Bagas Prakoso',
                'kelas'         => 10,
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 1
            ],
            [
                'nisn'          => '1000000010',
                'nama'          => 'Lestari Dewi',
                'kelas'         => 11,
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 3
            ]
        ];

        $this->db->table('siswa')->insertBatch($data);
    }
}