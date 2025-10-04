<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSanksiSiswaTable extends Migration
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
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'pelanggaran_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'tanggal_pelanggaran' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'poin_didapat' => [
                'type' => 'INT',
                'null' => false,
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

        // Foreign keys
        $this->forge->addForeignKey('siswa_id', 'siswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pelanggaran_id', 'pelanggaran', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('sanksi_siswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('sanksi_siswa', true);
    }
}
