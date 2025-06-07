<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryKonfirmasiModel extends Model
{
    protected $table            = 'history_konfirmasi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'izin_id', 'nama', 'kelas', 'waktu_keluar', 'waktu_kembali', 'waktu_kembali_siswa', 'poin_pelanggaran'
    ];
    protected $useTimestamps = true;
}
