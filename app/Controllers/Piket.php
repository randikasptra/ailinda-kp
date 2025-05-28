<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SuratIzinModel;


class Piket extends BaseController
{
    public function formIzin()
    {
        $siswaModel = new SiswaModel();
        $keyword = $this->request->getGet('keyword');
        $selectedNISN = $this->request->getGet('nisn');

        $siswaList = [];
        $selectedSiswa = null;

        if ($keyword) {
            $siswaList = $siswaModel
                ->like('nisn', $keyword)
                ->orLike('nama', $keyword)
                ->findAll();

            if (count($siswaList) === 1) {
                $selectedSiswa = $siswaList[0];
            } elseif ($selectedNISN) {
                // ambil data spesifik dari dropdown
                $selectedSiswa = $siswaModel->where('nisn', $selectedNISN)->first();
            }
        }

        return view('pages/piket/surat_izin', [
            'title' => 'Form Surat Izin',
            'siswaList' => $siswaList,
            'siswa' => $selectedSiswa,
            'keyword' => $keyword,
        ]);
    }




    public function cetakIzin($id)
    {
        $model = new SuratIzinModel();
        $izin = $model->find($id);

        if (!$izin) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data tidak ditemukan');
        }

        return view('pages/piket/izin_cetak', [
            'izin' => $izin,
            'title' => 'Cetak Surat Izin'
        ]);
    }


    public function simpanIzin()
    {
        $model = new SuratIzinModel();

        $data = [
            'nama'           => $this->request->getPost('nama'),
            'nisn'           => $this->request->getPost('nisn'),
            'kelas'          => $this->request->getPost('kelas'),
            'alasan'         => $this->request->getPost('alasan'),
            'waktu_keluar'   => $this->request->getPost('waktu_keluar'),
            'waktu_kembali'  => $this->request->getPost('waktu_kembali'),
        ];

        $insertedId = $model->insert($data);

        return redirect()->to('/piket/surat_izin/cetak/' . $insertedId);
    }
}
