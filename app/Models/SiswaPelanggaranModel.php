<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaPelanggaranModel extends Model
{
    protected $table            = 'siswa_pelanggaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'siswa_id',
        'pelanggaran_id',
        'tanggal',
        'catatan',
    ];

    protected $useTimestamps = true; // otomatis isi created_at & updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // relasi ke tabel siswa
    public function getWithSiswa()
    {
        return $this->select('siswa_pelanggaran.*, siswa.nama, siswa.nisn, siswa.kelas')
            ->join('siswa', 'siswa.id = siswa_pelanggaran.siswa_id');
    }

    // relasi ke tabel pelanggaran
    public function getWithPelanggaran()
    {
        return $this->select('siswa_pelanggaran.*, pelanggaran.nama_pelanggaran, pelanggaran.poin')
            ->join('pelanggaran', 'pelanggaran.id = siswa_pelanggaran.pelanggaran_id');
    }

    // relasi ke dua-duanya (siswa + pelanggaran)
    public function getFullData()
    {
        return $this->select('
                siswa_pelanggaran.*,
                siswa.nama as nama_siswa,
                siswa.nisn,
                siswa.kelas,
                pelanggaran.nama_pelanggaran,
                pelanggaran.poin
            ')
            ->join('siswa', 'siswa.id = siswa_pelanggaran.siswa_id')
            ->join('pelanggaran', 'pelanggaran.id = siswa_pelanggaran.pelanggaran_id');
    }
}
