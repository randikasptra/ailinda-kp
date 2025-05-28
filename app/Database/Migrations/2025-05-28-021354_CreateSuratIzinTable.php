<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratIzinTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'auto_increment' => true],
            'nama'           => ['type' => 'VARCHAR', 'constraint' => 100],
            'nisn'           => ['type' => 'VARCHAR', 'constraint' => 20],
            'kelas'          => ['type' => 'VARCHAR', 'constraint' => 50],
            'alasan'         => ['type' => 'TEXT'],
            'waktu_keluar'   => ['type' => 'TIME'],
            'waktu_kembali'  => ['type' => 'TIME'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('surat_izin');
    }

    public function down()
    {
        $this->forge->dropTable('surat_izin');
    }
}
