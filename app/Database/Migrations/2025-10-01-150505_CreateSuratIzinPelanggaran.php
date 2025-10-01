<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratIzinPelanggaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'surat_izin_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true, // bisa null kalau pelanggaran dari izin_masuk
            ],
            'surat_masuk_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true, // bisa null kalau pelanggaran dari izin_keluar
            ],
            'pelanggaran_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        // Relasi ke tabel izin keluar
        $this->forge->addForeignKey('surat_izin_id', 'surat_izin', 'id', 'CASCADE', 'CASCADE');

        // Relasi ke tabel izin masuk
        $this->forge->addForeignKey('surat_masuk_id', 'surat_izin_masuk', 'id', 'CASCADE', 'CASCADE');

        // Relasi ke tabel pelanggaran
        $this->forge->addForeignKey('pelanggaran_id', 'pelanggaran', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('surat_izin_pelanggaran');
    }

    public function down()
    {
        $this->forge->dropTable('surat_izin_pelanggaran');
    }
}
