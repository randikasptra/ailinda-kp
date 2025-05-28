<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'auto_increment' => true],
            'nisn'     => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'nama'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'kelas'    => ['type' => 'VARCHAR', 'constraint' => 10],
            'jurusan'  => ['type' => 'VARCHAR', 'constraint' => 50],
            'poin'     => ['type' => 'INT', 'default' => 0], // 🆕 Tambahkan kolom ini
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
