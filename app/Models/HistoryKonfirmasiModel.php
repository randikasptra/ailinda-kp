<?php

namespace App\Models;
use CodeIgniter\Model;

class HistoryKonfirmasiModel extends Model
{
    protected $table = 'history_konfirmasi';
    protected $allowedFields = [
        'izin_id', 'nama', 'kelas', 
        'waktu_keluar', 'waktu_kembali', 
        'waktu_kembali_siswa', 'created_at', 'updated_at'
    ];
}
