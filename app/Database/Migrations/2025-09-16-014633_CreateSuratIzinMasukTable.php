<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratIzinMasukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nisn' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'kelas' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'alasan_terlambat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tindak_lanjut' => [
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
        $this->forge->createTable('surat_izin_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('surat_izin_masuk');
    }
}
