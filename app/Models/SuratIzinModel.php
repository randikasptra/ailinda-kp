<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratIzinModel extends Model
{
    protected $table = 'surat_izin';
    protected $primaryKey = 'id';
    protected $allowedFields = [
    'nama',
    'nisn',
    'kelas',
    'alasan',
    'waktu_keluar',
    'waktu_kembali',
    // 'waktu_kembali_siswa',  
    // 'status',
    'poin_pelanggaran'
];


    protected $useTimestamps = true; // otomatis isi created_at & updated_at
}
