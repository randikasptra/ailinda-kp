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
        'poin_pelanggaran'
    ];

    protected $useTimestamps = true;

    // ✅ bikin method query khusus buat rekapan keluar
    public function getRekapanKeluarToday()
    {
        return $this->select('surat_izin.*, GROUP_CONCAT(pelanggaran.jenis_pelanggaran) as pelanggaran_nama')
                    ->join('surat_izin_pelanggaran', 'surat_izin_pelanggaran.surat_izin_id = surat_izin.id', 'left')
                    ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
                    ->where('DATE(surat_izin.created_at)', date('Y-m-d'))
                    ->groupBy('surat_izin.id');
    }
}
