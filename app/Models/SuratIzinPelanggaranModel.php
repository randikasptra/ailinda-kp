<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratIzinPelanggaranModel extends Model
{
    protected $table      = 'surat_izin_pelanggaran';
    protected $primaryKey = 'id';

    // ---- penting: tambahkan surat_masuk_id di allowedFields ----
    protected $allowedFields = [
        'surat_izin_id',
        'surat_masuk_id',
        'pelanggaran_id',
        'catatan',
    ];

    // timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ambil pelanggaran berdasarkan jenis surat (masuk/keluar)
     * @param string $type 'masuk' atau 'keluar'
     * @param int $id id surat (sesuai type)
     */
    public function getBySurat(string $type, int $id)
    {
        $this->select('surat_izin_pelanggaran.*, pelanggaran.jenis_pelanggaran, pelanggaran.poin');

        $this->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left');

        if ($type === 'masuk') {
            $this->join('surat_izin_masuk', 'surat_izin_masuk.id = surat_izin_pelanggaran.surat_masuk_id', 'left')
                 ->where('surat_izin_pelanggaran.surat_masuk_id', $id);
        } else {
            $this->join('surat_izin', 'surat_izin.id = surat_izin_pelanggaran.surat_izin_id', 'left')
                 ->where('surat_izin_pelanggaran.surat_izin_id', $id);
        }

        return $this->orderBy('surat_izin_pelanggaran.created_at', 'DESC')->findAll();
    }

    /**
     * Ambil semua pelanggaran pivot + sumber (masuk/keluar) — berguna untuk listing global
     */
    public function getAllWithSumber()
    {
        // IF()/CASE untuk menandai sumber; COALESCE untuk ambil data siswa kalau perlu
        $select = 'surat_izin_pelanggaran.*,
                   pelanggaran.jenis_pelanggaran,
                   pelanggaran.poin,
                   IF(surat_izin_pelanggaran.surat_izin_id IS NOT NULL, "keluar", "masuk") as sumber';

        return $this->select($select)
                    ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
                    ->orderBy('surat_izin_pelanggaran.created_at', 'DESC')
                    ->findAll();
    }
}
