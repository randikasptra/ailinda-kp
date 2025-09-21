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
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // contoh: "Ringan", "Sedang", "Berat"
                'null'       => false,
            ],
            'jenis_pelanggaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'poin' => [
                'type'       => 'INT',
                'null'       => false,
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
