<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratIzinModel extends Model
{
    protected $table = 'surat_izin';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'nisn', 'kelas', 'alasan', 'waktu_keluar', 'waktu_kembali', 'created_at'
    ];
    protected $useTimestamps = true; // otomatis isi created_at & updated_at
}
