<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRekapIzinTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'siswa_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'surat_izin_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true, // izin keluar
            ],
            'surat_masuk_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true, // izin masuk / terlambat
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'jenis' => [
                'type'       => "ENUM('izin_keluar','izin_masuk')",
                'default'    => 'izin_keluar',
            ],
            'pelanggaran_list' => [
                'type' => 'TEXT',
                'null' => true, // bisa JSON atau string daftar pelanggaran
            ],
            'total_poin' => [
                'type'    => 'INT',
                'default' => 0,
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

        // Relasi opsional
        $this->forge->addForeignKey('siswa_id', 'siswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('surat_izin_id', 'surat_izin', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('surat_masuk_id', 'surat_izin_masuk', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('rekap_izin');
    }

    public function down()
    {
        $this->forge->dropTable('rekap_izin');
    }
}
