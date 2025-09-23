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

    // Display the form and list of surat izin masuk
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $selectedNIS = $this->request->getGet('nis');
        $siswaList = [];
        $selectedSiswa = null;

        if ($keyword) {
            $siswaList = $this->siswaModel
                ->groupStart()
                    ->like('nis', $keyword)
                    ->orLike('nama', $keyword)
                ->groupEnd()
                ->findAll();

            if (count($siswaList) === 1) {
                $selectedSiswa = $siswaList[0];
            } elseif ($selectedNIS) {
                $selectedSiswa = $this->siswaModel->where('nis', $selectedNIS)->first();
            }
        }

        $data = [
            'keyword' => $keyword,
            'siswaList' => $siswaList,
            'siswa' => $selectedSiswa,
            'suratMasukList' => $this->izinMasukModel->findAll(),
        ];

        return view('pages/piket/izin_masuk_form', $data);
    }

    // Save surat izin masuk data
    public function simpan()
    {
        if (!$this->validate([
            'nama' => 'required',
            'nis' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'alasan_terlambat' => 'required',
            'tindak_lanjut' => 'required',
        ])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Semua field wajib diisi'
            ]);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'nisn' => $this->request->getPost('nis'), // Map nis to nisn
            'kelas' => $this->request->getPost('kelas'),
            'jurusan' => $this->request->getPost('jurusan'),
            'alasan_terlambat' => $this->request->getPost('alasan_terlambat'),
            'tindak_lanjut' => $this->request->getPost('tindak_lanjut'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->izinMasukModel->insert($data)) {
            session()->setFlashdata('success', 'Surat izin masuk berhasil disimpan!');
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Surat izin masuk berhasil disimpan'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan surat izin masuk'
            ]);
        }
    }

    // Edit surat izin masuk
    public function edit($id)
    {
        $surat = $this->izinMasukModel->find($id);
        if (!$surat) {
            return redirect()->to(base_url('piket/surat_izin_masuk'))
                ->with('error', 'Surat tidak ditemukan');
        }

        $data = [
            'surat' => $surat,
            'suratMasukList' => $this->izinMasukModel->findAll(),
        ];

        return view('pages/piket/izin_masuk_form', $data);
    }

    // Delete surat izin masuk
    public function delete($id)
    {
        if ($this->izinMasukModel->delete($id)) {
            session()->setFlashdata('success', 'Surat izin masuk berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus surat izin masuk.');
        }

        return redirect()->to(base_url('piket/history_konfirmasi'));
    }
}