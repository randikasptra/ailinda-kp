<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusKembaliToSuratIzin extends Migration
{
    public function up()
{
    $this->forge->addColumn('surat_izin', [
        'status_kembali' => [
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'default'    => 'belum kembali',
        ],
        'poin_pelanggaran' => [
            'type'       => 'INT',
            'default'    => 0,
        ]
    ]);
}


    public function down()
    {
        //
    }
}
