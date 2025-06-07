<?php

// 1. Seeder: PelanggaranSeeder.php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelanggaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['jenis_pelanggaran' => 'Terlambat datang ke madrasah.', 'poin' => 5],
            ['jenis_pelanggaran' => 'Berkuku panjang.', 'poin' => 5],
            ['jenis_pelanggaran' => 'Menggulung lengan baju', 'poin' => 5],
            ['jenis_pelanggaran' => 'Menggunakan pakaian atau atribut di luar ketentuan', 'poin' => 5],
            ['jenis_pelanggaran' => 'Menggunakan perhiasan berlebihan.', 'poin' => 5],
            ['jenis_pelanggaran' => 'Menggunakan asesoris', 'poin' => 5],
            ['jenis_pelanggaran' => 'Meninggalkan kelas tanpa seizin guru saat pembelajaran.', 'poin' => 10],
            ['jenis_pelanggaran' => 'Meninggalkan madrasah tanpa seizin guru piket sebelum KBM berakhir', 'poin' => 15],
            ['jenis_pelanggaran' => 'Menggunakan pewarna bibir, penebal alis, maskara, eyeshadow, lensa mata, cat kuku, dan henna.', 'poin' => 15],
            ['jenis_pelanggaran' => 'Rambut diwarnai/gondrong/model tidak normatif.', 'poin' => 25],
            ['jenis_pelanggaran' => 'Mengubah bentuk alis.', 'poin' => 25],
            ['jenis_pelanggaran' => 'Tidak menyimpan handphone/tablet ke locker madrasah.', 'poin' => 25],
        ];

        $this->db->table('pelanggaran')->insertBatch($data);
    }
}

// 2. Model: PelanggaranModel.php
namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $table = 'pelanggaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_pelanggaran', 'poin'];
}

// 3. Controller: Pelanggaran.php
namespace App\Controllers;

use App\Models\PelanggaranModel;
use CodeIgniter\Controller;

class Pelanggaran extends BaseController
{
    public function index()
    {
        $model = new PelanggaranModel();
        $data = [
            'title' => 'Data Pelanggaran',
            'pelanggaran' => $model->findAll()
        ];

        return view('pages/pelanggaran/index', $data);
    }
}
