<?php

namespace App\Controllers;

use App\Models\SuratIzinModel;
use App\Models\SuratIzinMasukModel;

class LaporanIzinController extends BaseController
{
    protected $izinKeluarModel;
    protected $izinMasukModel;

    public function __construct()
    {
        $this->izinKeluarModel = new SuratIzinModel();
        $this->izinMasukModel  = new SuratIzinMasukModel();
    }

    public function index()
    {
        $data = [
            'izinKeluar' => $this->izinKeluarModel->orderBy('created_at', 'DESC')->findAll(),
            'izinMasuk'  => $this->izinMasukModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('pages/piket/izin', $data);
    }
}
