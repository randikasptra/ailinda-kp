<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratIzinMasukModel extends Model
{
    protected $table            = 'surat_izin_masuk';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id_siswa',
        'alasan_terlambat',
        'tindak_lanjut',
        'created_at',
        'updated_at'
    ];

    // Aktifkan otomatis isi created_at & updated_at
    protected $useTimestamps = true;

    // 🔎 Relasi join dengan tabel siswa
    public function getWithSiswa($id = null)
    {
        $builder = $this->select('surat_izin_masuk.*, siswa.nama, siswa.nisn, siswa.kelas, siswa.jurusan')
                        ->join('siswa', 'siswa.id = surat_izin_masuk.id_siswa');

        if ($id !== null) {
            $builder->where('surat_izin_masuk.id', $id);
            return $builder->first();
        }

        return $builder->findAll();
    }
}
