<?php
namespace App\Models;

use CodeIgniter\Model;

class SuratIzinMasukModel extends Model
{
    protected $table = 'surat_izin_masuk';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
        'nisn',
        'kelas',
        'alasan_terlambat',
        'tindak_lanjut',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Ambil semua surat izin masuk
     * Bisa difilter pakai keyword (cari nama / nisn / kelas)
     */
    public function getSuratIzinMasuk($id = null, $keyword = null)
    {
        $builder = $this->db->table($this->table);

        if ($keyword) {
            $builder->groupStart()
                ->like('nisn', $keyword)
                ->orLike('nama', $keyword)
                ->orLike('kelas', $keyword)
                ->groupEnd();
        }

        if ($id !== null) {
            $builder->where('id', $id);
            return $builder->get()->getRowArray();
        }

        return $builder->orderBy('created_at', 'DESC')->get()->getResultArray();
    }

    /**
     * Ambil surat izin masuk berdasarkan NISN
     */
    public function getByNisn($nisn)
    {
        return $this->where('nisn', $nisn)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }
}
