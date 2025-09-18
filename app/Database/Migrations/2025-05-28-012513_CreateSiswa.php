<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nis'           => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => false], // sesuai kolom NIS di Excel
            'nism'          => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],  // optional
            'nama'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'kelas'         => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => true],  // contoh: "10.01"
            'no_absen'      => ['type' => 'INT', 'null' => true],
            'jk'            => ['type' => 'ENUM', 'constraint' => ['L', 'P'], 'null' => true],
            'jurusan'       => ['type' => 'ENUM', 'constraint' => ['SOSHUM', 'SAINTEK', 'BAHASA'], 'null' => true],
            'tahun_ajaran'  => ['type' => 'VARCHAR', 'constraint' => 9, 'null' => true], // "2021/2022"
            'poin'          => ['type' => 'INT', 'default' => 0],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        // buat table jika belum ada (lebih sederhana daripada cek manual dengan $this->db)
        $this->forge->createTable('siswa', true);
    }

    public function down()
    {
        // drop table jika ada
        $this->forge->dropTable('siswa', true);
    }
}
