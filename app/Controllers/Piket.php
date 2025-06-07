<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SuratIzinModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\HistoryKonfirmasiModel;


class Piket extends BaseController
{
    protected $siswaModel;
    protected $izinModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->izinModel  = new SuratIzinModel();
    }

    public function formIzin()
    {
        $keyword = $this->request->getGet('keyword');
        $selectedNISN = $this->request->getGet('nisn');

        $siswaList = [];
        $selectedSiswa = null;

        if ($keyword) {
            $siswaList = $this->siswaModel
                ->like('nisn', $keyword)
                ->orLike('nama', $keyword)
                ->findAll();

            if (count($siswaList) === 1) {
                $selectedSiswa = $siswaList[0];
            } elseif ($selectedNISN) {
                $selectedSiswa = $this->siswaModel->where('nisn', $selectedNISN)->first();
            }
        }

        return view('pages/piket/surat_izin', [
            'title'      => 'Form Surat Izin',
            'siswaList'  => $siswaList,
            'siswa'      => $selectedSiswa,
            'keyword'    => $keyword,
        ]);
    }

    public function simpanIzin()
    {
        $data = [
            'nama'              => $this->request->getPost('nama'),
            'nisn'              => $this->request->getPost('nisn'),
            'kelas'             => $this->request->getPost('kelas'),
            'alasan'            => $this->request->getPost('alasan'),
            'waktu_keluar'      => $this->request->getPost('waktu_keluar'),
            'waktu_kembali'     => $this->request->getPost('waktu_kembali'),
            'status_kembali'    => 'belum kembali',
            'poin_pelanggaran'  => 0,
        ];

        $insertedId = $this->izinModel->insert($data);

        return redirect()->to('/piket/izin_cetak/' . $insertedId);
    }

    public function cetakIzin($id)
    {
        $izin = $this->izinModel->find($id);

        if (!$izin) {
            throw PageNotFoundException::forPageNotFound('Data tidak ditemukan');
        }

        return view('pages/piket/izin_cetak', [
            'izin'  => $izin,
            'title' => 'Cetak Surat Izin',
        ]);
    }

    public function konfirmasiKembali()
    {
        $izinList = $this->izinModel
            ->where('status_kembali', 'belum kembali')
            ->findAll();

        return view('pages/piket/konfirmasi_kembali', [
            'title'    => 'Konfirmasi Siswa Kembali',
            'izinList' => $izinList,
        ]);
    }
    public function history()
{
    $historyModel = new HistoryKonfirmasiModel();
    $data = [
        'title' => 'Riwayat Konfirmasi Kembali',
        'historyList' => $historyModel->orderBy('created_at', 'DESC')->findAll(),
    ];
    return view('pages/piket/history_konfirmasi', $data);
}

   public function dataSiswa()
{
    $keyword   = $this->request->getGet('keyword');
    $kelas     = $this->request->getGet('kelas');
    $jurusan   = $this->request->getGet('jurusan');

    $builder = $this->siswaModel;

    if ($keyword) {
        $builder = $builder->groupStart()
                           ->like('nama', $keyword)
                           ->orLike('nisn', $keyword)
                           ->groupEnd();
    }

    if ($kelas) {
        $builder = $builder->where('kelas', $kelas);
    }

    if ($jurusan) {
        $builder = $builder->where('jurusan', $jurusan);
    }

    $siswa = $builder->findAll();

    return view('pages/piket/data_siswa', [
        'title'   => 'Data Siswa',
        'siswa'   => $siswa,
        'filter'  => [
            'keyword' => $keyword,
            'kelas'   => $kelas,
            'jurusan' => $jurusan
        ]
    ]);
}


    public function catatPelanggaran()
{
    $id     = $this->request->getPost('izin_id');
    $poin   = (int) $this->request->getPost('poin_pelanggaran');
    $waktu  = $this->request->getPost('waktu_kembali_siswa');

    $this->izinModel->update($id, [
        'status_kembali'       => 'sudah kembali',
        'poin_pelanggaran'     => $poin,
        'waktu_kembali_siswa'  => $waktu
    ]);

    $historyModel = new \App\Models\HistoryKonfirmasiModel(); 
    $izin = $this->izinModel->find($id);
    $historyModel->insert([
        'izin_id'              => $izin['id'],
        'nama'                 => $izin['nama'],
        'kelas'                => $izin['kelas'],
        'waktu_keluar'         => $izin['waktu_keluar'],
        'waktu_kembali'        => $izin['waktu_kembali'],
        'waktu_kembali_siswa'  => $waktu,
        'poin_pelanggaran'     => $poin,
    ]);

    return redirect()->to('/piket/konfirmasi_kembali')->with('success', 'Data berhasil dikonfirmasi.');
}

}
