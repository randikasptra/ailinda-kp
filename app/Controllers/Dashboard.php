<?php

namespace App\Controllers;

use App\Models\SuratIzinModel;

class Dashboard extends BaseController
{
    protected $izinModel;

    public function __construct()
    {
        $this->izinModel = new SuratIzinModel();
    }

    public function piket()
    {
        $today = date('Y-m-d');

        // Data dinamis
        $totalIzinHariIni = $this->izinModel
            ->where('DATE(waktu_keluar)', $today)
            ->countAllResults();

        $belumKembali = $this->izinModel
            ->where('status_kembali', 'belum kembali')
            ->countAllResults();

        $pelanggaranHariIni = $this->izinModel
            ->where('DATE(waktu_keluar)', $today)
            ->where('poin_pelanggaran >', 0)
            ->countAllResults();

        return view('pages/piket/piket', [
            'title'              => 'Dashboard Piket',
            'totalIzinHariIni'   => $totalIzinHariIni,
            'belumKembali'       => $belumKembali,
            'pelanggaranHariIni' => $pelanggaranHariIni,
        ]);
    }

    public function bp()
    {
        return view('pages/bp/bp', ['title' => 'Dashboard BP']);
    }

    public function admin()
    {
        return view('pages/admin/dashboard', ['title' => 'Dashboard Admin']);
    }
}
