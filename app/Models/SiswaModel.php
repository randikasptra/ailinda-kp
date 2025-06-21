<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nisn',
        'nama',
        'kelas',          // integer: 10, 11, 12
        'jurusan',        // enum: SOSHUM, SAINTEK, BAHASA
        'tahun_ajaran',   // string: '2024/2025'
        'poin',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
}