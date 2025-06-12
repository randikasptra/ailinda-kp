<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $table      = 'pelanggaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_pelanggaran', 'poin', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
