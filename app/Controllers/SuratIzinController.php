<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\Controller;
use App\Models\SuratIzinModel;

class SuratIzinController extends Controller
{
    public function index()
    {
        return view('surat_izin_form');
    }

    // 🔎 Endpoint untuk AJAX autocomplete
    public function search()
    {
        $keyword = $this->request->getGet('q'); // ambil keyword dari input

        $siswaModel = new SiswaModel();

        $results = $siswaModel
            ->like('nama', $keyword)
            ->orLike('nisn', $keyword)
            ->findAll(10); // limit 10 hasil

        return $this->response->setJSON($results);
    }

    // 🚀 Simpan data izin (contoh sederhana)
    public function simpan()
    {
        $data = $this->request->getPost();

        // nanti di sini masukin logika simpan surat izin
        return redirect()->back()->with('success', 'Surat izin berhasil disimpan!');
    }

     public function store()
    {
        $suratIzinModel = new SuratIzinModel();

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'nisn'          => $this->request->getPost('nisn'),
            'kelas'         => $this->request->getPost('kelas'),
            'alasan'        => $this->request->getPost('alasan'),
            'waktu_keluar'  => $this->request->getPost('waktu_keluar'),
            'waktu_kembali' => $this->request->getPost('waktu_kembali'),
            'status'        => 'belum kembali'
        ];

        if ($suratIzinModel->save($data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Surat izin berhasil disimpan!'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal menyimpan surat izin.'
            ]);
        }
    }
}
