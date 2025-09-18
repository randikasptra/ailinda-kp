<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nis',
        'nism',
        'nama',
        'kelas',
        'no_absen',
        'jk',
        'jurusan',
        'tahun_ajaran',
        'poin',
        'created_at',
        'updated_at',
    ];

    // Timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';
}
