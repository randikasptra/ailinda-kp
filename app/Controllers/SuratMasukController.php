<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SuratIzinMasukModel;
use CodeIgniter\Controller;

class SuratIzinMasukController extends Controller
{
    protected $siswaModel;
    protected $izinMasukModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->izinMasukModel = new SuratIzinMasukModel();
    }

    // ✅ TAMPILKAN FORM IZIN MASUK
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $nisn = $this->request->getGet('nisn');
        $siswa = null;
        $siswaList = [];

        if ($keyword) {
            $siswaList = $this->siswaModel
                ->like('nama', $keyword)
                ->orLike('nisn', $keyword)
                ->findAll();
        }

        if ($nisn) {
            $siswa = $this->siswaModel->where('nisn', $nisn)->first();
        } elseif (count($siswaList) === 1) {
            $siswa = $siswaList[0];
        }

        return view('pages/piket/izin_masuk_form', [
            'keyword'   => $keyword,
            'siswaList' => $siswaList,
            'siswa'     => $siswa,
        ]);
    }

    // ✅ SIMPAN DATA IZIN MASUK
    public function simpan()
    {
        $this->izinMasukModel->insert([
            'nisn'             => $this->request->getPost('nisn'),
            'nama'             => $this->request->getPost('nama'),
            'kelas'            => $this->request->getPost('kelas'),
            'alasan_terlambat' => $this->request->getPost('alasan_terlambat'),
            'tindak_lanjut'    => $this->request->getPost('tindak_lanjut'),
        ]);

        return redirect()->to(base_url('piket/surat_izin_masuk'))
            ->with('success', 'Surat izin masuk berhasil disimpan!');
    }
}
