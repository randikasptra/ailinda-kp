<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nisn' => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'kelas' => ['type' => 'INT'], // ✅ kelas diubah ke INT
            'tahun_ajaran' => ['type' => 'VARCHAR', 'constraint' => 9], // contoh: 2024/2025
            'jurusan' => [
                'type' => 'ENUM',
                'constraint' => ['SOSHUM', 'SAINTEK', 'BAHASA'],
            ],
            'poin' => ['type' => 'INT', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);

        if (!$this->db->tableExists('siswa')) {
            $this->forge->createTable('siswa');
        }
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}
