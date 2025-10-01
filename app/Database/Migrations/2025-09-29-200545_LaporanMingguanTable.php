<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanMingguanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'minggu_ke' => [
                'type' => 'INT',
            ],
            'tahun' => [
                'type' => 'INT',
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
        $this->forge->createTable('laporan_mingguan');
    }

    public function down()
    {
        $this->forge->dropTable('laporan_mingguan');
    }
}