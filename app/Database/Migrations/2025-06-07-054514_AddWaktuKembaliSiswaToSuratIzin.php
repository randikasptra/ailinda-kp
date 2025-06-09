<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWaktuKembaliSiswaToSuratIzin extends Migration
{
    public function up()
    {
        $fields = [
            'waktu_kembali_siswa' => [
                'type' => 'TIME',
                'null' => true,
            ],
        ];

        $this->forge->addColumn('surat_izin', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('surat_izin', 'waktu_kembali_siswa');
    }
}
