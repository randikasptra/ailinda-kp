<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoryKonfirmasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'izin_id' => ['type' => 'INT'],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'kelas' => ['type' => 'VARCHAR', 'constraint' => 10],
            'waktu_keluar' => ['type' => 'TIME'],
            'waktu_kembali' => ['type' => 'TIME'],
            'waktu_kembali_siswa' => ['type' => 'TIME', 'null' => true],
            'poin_pelanggaran' => ['type' => 'INT', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('history_konfirmasi');
    }

    public function down()
    {
        $this->forge->dropTable('history_konfirmasi');
    }
}