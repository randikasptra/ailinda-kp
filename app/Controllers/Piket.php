<?php

namespace App\Controllers;

use App\Models\SiswaModel;

class Piket extends BaseController
{
    public function formIzin()
    {
        $siswaModel = new SiswaModel();
        $keyword = $this->request->getGet('keyword');

        $siswa = null; // default null
        if ($keyword) {
            $siswa = $siswaModel
                ->groupStart()
                    ->like('nisn', $keyword)
                    ->orLike('nama', $keyword)
                ->groupEnd()
                ->first(); // ambil hanya 1 siswa (pertama ditemukan)
        }

        return view('pages/piket/surat_izin', [
            'title' => 'Form Surat Izin',
            'siswa' => $siswa,
            'keyword' => $keyword,
        ]);
    }

    public function simpanIzin()
    {
        $data = [
            'nama'           => $this->request->getPost('nama'),
            'kelas'          => $this->request->getPost('kelas'),
            'nisn'           => $this->request->getPost('nisn'),
            'alasan'         => $this->request->getPost('alasan'),
            'waktu_keluar'   => $this->request->getPost('waktu_keluar'),
            'waktu_kembali'  => $this->request->getPost('waktu_kembali'),
        ];

        // Simpan ke database nanti di sini (kalau udah ada model izin)
        // $this->izinModel->insert($data);

        session()->setFlashdata('success', 'Surat izin berhasil disimpan.');
        return redirect()->to('/piket/surat_izin');
    }
}
