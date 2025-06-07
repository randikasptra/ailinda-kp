<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelanggaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'jenis_pelanggaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'poin' => [
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

        $this->forge->createTable('pelanggaran');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggaran');
    }
}
