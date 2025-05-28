<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\Controller;

class Piket extends BaseController
{
    public function formIzin()
    {
        $siswaModel = new SiswaModel();
        $keyword = $this->request->getGet('keyword');

        $siswa = [];
        if ($keyword) {
            $siswa = $siswaModel
                ->like('nisn', $keyword)
                ->orLike('nama', $keyword)
                ->findAll();
        }

        return view('pages/piket/surat_izin', [
            'title' => 'Form Surat Izin',
            'siswa' => $siswa,
            'keyword' => $keyword,
        ]);
    }


    public function simpanIzin()
    {
        // Ambil data dari form
        $data = [
            'nama'           => $this->request->getPost('nama'),
            'kelas'          => $this->request->getPost('kelas'),
            'alasan'         => $this->request->getPost('alasan'),
            'waktu_kembali'  => $this->request->getPost('waktu_kembali'),
        ];

        // TODO: Simpan ke database (sementara tampilkan aja dulu)
        // Contoh simpan ke database (jika ada model):
        // $this->izinModel->insert($data);

        // Buat flashdata
        session()->setFlashdata('success', 'Surat izin berhasil disimpan.');

        // Redirect balik ke form
        return redirect()->to('/piket/surat_izin');
    }
}
