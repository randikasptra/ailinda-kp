<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoryKonfirmasiPelanggaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'history_konfirmasi_id' => ['type' => 'INT'],
            'pelanggaran_id' => ['type' => 'INT'],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('history_konfirmasi_id', 'history_konfirmasi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pelanggaran_id', 'pelanggaran', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('history_konfirmasi_pelanggaran');
    }

    public function down()
    {
        $this->forge->dropTable('history_konfirmasi_pelanggaran');
    }
}
