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
                'nis'           => '250001',
                'nism'          => 'NSM001',
                'nama'          => 'Agna Nahla',
                'kelas'         => '10.01',
                'no_absen'      => 1,
                'jk'            => 'P',
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 0
            ],
            [
                'nis'           => '250002',
                'nism'          => 'NSM002',
                'nama'          => 'Bilal Rohmat',
                'kelas'         => '10.01',
                'no_absen'      => 2,
                'jk'            => 'L',
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 3
            ],
            [
                'nis'           => '250003',
                'nism'          => 'NSM003',
                'nama'          => 'Dina Safitri',
                'kelas'         => '11.01',
                'no_absen'      => 3,
                'jk'            => 'P',
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 5
            ],
            [
                'nis'           => '250004',
                'nism'          => 'NSM004',
                'nama'          => 'Rafi Pratama',
                'kelas'         => '12.01',
                'no_absen'      => 4,
                'jk'            => 'L',
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 2
            ],
            [
                'nis'           => '250005',
                'nism'          => 'NSM005',
                'nama'          => 'Nisa Khairunnisa',
                'kelas'         => '10.02',
                'no_absen'      => 5,
                'jk'            => 'P',
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 1
            ],
            [
                'nis'           => '250006',
                'nism'          => 'NSM006',
                'nama'          => 'M. Rizky Alfarizi',
                'kelas'         => '10.02',
                'no_absen'      => 6,
                'jk'            => 'L',
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 4
            ],
            [
                'nis'           => '250007',
                'nism'          => 'NSM007',
                'nama'          => 'Siti Maesaroh',
                'kelas'         => '11.02',
                'no_absen'      => 7,
                'jk'            => 'P',
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 6
            ],
            [
                'nis'           => '250008',
                'nism'          => 'NSM008',
                'nama'          => 'Ahmad Putra',
                'kelas'         => '11.02',
                'no_absen'      => 8,
                'jk'            => 'L',
                'jurusan'       => 'SOSHUM',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 2
            ],
            [
                'nis'           => '250009',
                'nism'          => 'NSM009',
                'nama'          => 'Rina Wulandari',
                'kelas'         => '12.01',
                'no_absen'      => 9,
                'jk'            => 'P',
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 7
            ],
            [
                'nis'           => '250010',
                'nism'          => 'NSM010',
                'nama'          => 'Bagas Prakoso',
                'kelas'         => '12.01',
                'no_absen'      => 10,
                'jk'            => 'L',
                'jurusan'       => 'SAINTEK',
                'tahun_ajaran'  => '2024/2025',
                'poin'          => 5
            ],
        ];

        $this->db->table('siswa')->insertBatch($data);
    }
}
