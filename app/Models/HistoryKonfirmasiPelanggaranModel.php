<?php

namespace App\Models;
use CodeIgniter\Model;

class HistoryKonfirmasiPelanggaranModel extends Model
{
    protected $table = 'history_konfirmasi_pelanggaran';
    protected $allowedFields = ['history_konfirmasi_id', 'pelanggaran_id'];
}
