<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\HistoryKonfirmasiModel;

class Bp extends BaseController
{
    public function rekapPoin()
    {
        $siswaModel = new SiswaModel();
        $data = [
            'title' => 'Rekap Poin Pelanggaran',
            'siswaList' => $siswaModel->findAll()
        ];

        return view('pages/bp/rekap_poin', $data);
    }

    public function index()
    {
        $siswaModel = new SiswaModel();
        $historyModel = new HistoryKonfirmasiModel();

        // Ambil bulan ini (format: YYYY-MM)
        $bulanIni = date('Y-m');

        // Total pelanggaran dari history_konfirmasi bulan ini
        $totalPelanggaranBulanIni = $historyModel
            ->where("DATE_FORMAT(created_at, '%Y-%m')", $bulanIni)
            ->countAllResults();

        // Jumlah siswa mendekati DO (≥180 poin)
        $jumlahSiswaMendekatiDO = $siswaModel
            ->where('poin >=', 180)
            ->countAllResults();

        // Ambil 5 siswa dengan poin tertinggi
        $topSiswa = $siswaModel
            ->orderBy('poin', 'DESC')
            ->limit(5)
            ->findAll();

        return view('pages/bp/bp', [
            'title' => 'Dashboard BP',
            'totalPelanggaranBulanIni' => $totalPelanggaranBulanIni,
            'jumlahSiswaMendekatiDO' => $jumlahSiswaMendekatiDO,
            'topSiswa' => $topSiswa
        ]);
    }

    public function hapusPoin($id)
    {
        $siswaModel = new SiswaModel();

        // Set poin ke 0 untuk siswa tersebut
        $siswaModel->update($id, ['poin' => 0]);

        return redirect()->back()->with('success', 'Poin siswa berhasil dihapus.');
    }
}