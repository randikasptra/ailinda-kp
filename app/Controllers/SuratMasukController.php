<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SuratIzinMasukModel;
use CodeIgniter\Controller;

class SuratMasukController extends Controller
{
    protected $siswaModel;
    protected $izinMasukModel;
    protected $request;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->izinMasukModel = new SuratIzinMasukModel();
        $this->request = service('request');
    }

    // ✅ TAMPILKAN FORM IZIN MASUK
    public function izin_masuk_form()
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

        return view('piket/izin_masuk_form', [
            'keyword' => $keyword,
            'siswaList' => $siswaList,
            'siswa' => $siswa
        ]);
    }

    // ✅ SIMPAN DATA IZIN MASUK
    public function simpanIzinMasuk()
    {
        $data = [
            'nisn' => $this->request->getPost('nisn'),
            'nama' => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas'),
            'jurusan' => $this->request->getPost('jurusan'),
            'alasan_terlambat' => $this->request->getPost('alasan_terlambat'),
            'tindak_lanjut' => $this->request->getPost('tindak_lanjut'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->izinMasukModel->insert($data);

        return redirect()->to('/piket/izin_masuk_form')->with('success', 'Surat izin masuk berhasil disimpan!');
    }
}
