<?php

namespace App\Models;

use CodeIgniter\Model;

class SanksiSiswaModel extends Model
{
    protected $table = 'sanksi_siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'siswa_id', 'pelanggaran_id', 'tanggal_pelanggaran', 'keterangan', 'poin_didapat',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;

    // Relasi opsional
    public function siswa()
    {
        return $this->belongsTo(SiswaModel::class, 'siswa_id');
    }

    public function pelanggaran()
    {
        return $this->belongsTo(PelanggaranModel::class, 'pelanggaran_id');
    }
}
