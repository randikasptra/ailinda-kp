<?php
namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SuratIzinModel;

class Bp extends BaseController
{
    protected $siswaModel;
    protected $izinModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->izinModel  = new SuratIzinModel();
    }

    public function index()
    {
        $bulanIni = date('Y-m'); // contoh: '2025-06'

        // Hitung total poin pelanggaran bulan ini dari tabel surat izin
        $total = $this->izinModel
            ->selectSum('poin_pelanggaran')
            ->like('updated_at', $bulanIni, 'after')
            ->where('status', 'sudah kembali')
            ->first();

        $totalPelanggaran = $total['poin_pelanggaran'] ?? 0;

        // Hitung siswa yang mendekati DO (≥ 180 poin)
        $siswaMendekatiDO = $this->siswaModel
            ->where('poin >=', 180)
            ->countAllResults();

        return view('pages/bp/bp', [
            'totalPelanggaran' => $totalPelanggaran,
            'siswaMendekatiDO' => $siswaMendekatiDO,
            'title' => 'Dashboard BP'
        ]);
    }
}