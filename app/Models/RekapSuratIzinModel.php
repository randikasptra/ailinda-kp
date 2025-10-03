<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapSuratIzinModel extends Model
{
    protected $table            = 'rekap_izin';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'siswa_id',
        'surat_izin_id',
        'pelanggaran_id',
        'poin_pelanggaran',
        'tanggal'
    ];

    // Ambil data rekap dengan join ke siswa & pelanggaran
    public function getRekap($filter = null)
    {
        $builder = $this->db->table($this->table)
            ->select('rekap_surat_izin.id, siswa.nama, surat_izin.tanggal, surat_izin.waktu_keluar, surat_izin.waktu_masuk, surat_izin.alasan, pelanggaran.nama_pelanggaran, rekap_surat_izin.poin_pelanggaran')
            ->join('siswa', 'siswa.id = rekap_surat_izin.siswa_id')
            ->join('surat_izin', 'surat_izin.id = rekap_surat_izin.surat_izin_id')
            ->join('pelanggaran', 'pelanggaran.id = rekap_surat_izin.pelanggaran_id', 'left');

        if ($filter) {
            $builder->where($filter);
        }

        return $builder->get()->getResultArray();
    }
}
