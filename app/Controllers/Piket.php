<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SuratIzinModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\HistoryKonfirmasiModel;
use App\Models\PelanggaranModel;
use CodeIgniter\I18n\Time;

class Piket extends BaseController
{
    protected $siswaModel;
    protected $izinModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->izinModel = new SuratIzinModel();
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
            'title' => 'Form Surat Izin',
            'siswaList' => $siswaList,
            'siswa' => $selectedSiswa,
            'keyword' => $keyword,
        ]);
    }

    public function simpanIzin()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nisn' => $this->request->getPost('nisn'),
            'kelas' => $this->request->getPost('kelas'),
            'alasan' => $this->request->getPost('alasan'),
            'waktu_keluar' => $this->request->getPost('waktu_keluar'),
            'waktu_kembali' => $this->request->getPost('waktu_kembali'),
            'status_kembali' => 'belum kembali',
            'poin_pelanggaran' => 0,
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
            'izin' => $izin,
            'title' => 'Cetak Surat Izin',
        ]);
    }



    public function konfirmasiKembali()
    {
        $izinModel = new SuratIzinModel();
        $pelanggaranModel = new \App\Models\PelanggaranModel();

        // Ambil tanggal hari ini dalam format Y-m-d
        $today = date('Y-m-d');

        // Ambil semua data izin yang belum kembali dan dibuat hari ini
        $izinBelumKembali = $izinModel
            ->where('status', 'belum kembali')
            ->like('created_at', $today) // pastikan kolom created_at tersedia
            ->findAll();

        $data = [
            'title' => 'Konfirmasi Kembali',
            'izinList' => $izinBelumKembali,
            'pelanggaran' => $pelanggaranModel->findAll(),
            'belumKembali' => count($izinBelumKembali)
        ];

        return view('pages/piket/konfirmasi_kembali', $data);
    }
    public function history()
    {
        $izinModel = new \App\Models\SuratIzinModel();

        $data = [
            'title' => 'Riwayat Konfirmasi Kembali',
            'historyList' => $izinModel
                ->where('status', 'sudah kembali')
                ->orderBy('updated_at', 'DESC')
                ->findAll(),
        ];

        return view('pages/piket/history_konfirmasi', $data);
    }




    public function dataSiswa()
    {
        $keyword = $this->request->getGet('keyword');
        $kelas = $this->request->getGet('kelas');
        $jurusan = $this->request->getGet('jurusan');

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
            'title' => 'Data Siswa',
            'siswa' => $siswa,
            'filter' => [
                'keyword' => $keyword,
                'kelas' => $kelas,
                'jurusan' => $jurusan
            ]
        ]);
    }


    public function catatPelanggaran()
    {
        $izinModel = new SuratIzinModel();
        $pelanggaranModel = new PelanggaranModel();
        $siswaModel = new SiswaModel();

        $izinId = $this->request->getPost('izin_id');
        $waktuKembaliSiswa = $this->request->getPost('waktu_kembali_siswa');
        $pelanggaranId = $this->request->getPost('pelanggaran_id');

        if (!$izinId || !$waktuKembaliSiswa) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        $izin = $izinModel->find($izinId);
        if (!$izin) {
            return redirect()->back()->with('error', 'Data izin tidak ditemukan.');
        }

        $poinPelanggaran = 0;

        if ($pelanggaranId && is_array($pelanggaranId)) {
            $pelanggarans = $pelanggaranModel->find($pelanggaranId);
            foreach ($pelanggarans as $p) {
                if (isset($p['poin'])) {
                    $poinPelanggaran += $p['poin'];
                }
            }
        }

        // 1. Update data izin
        $izinModel->update($izinId, [
            'waktu_kembali_siswa' => $waktuKembaliSiswa,
            'status' => 'sudah kembali',
            'poin_pelanggaran' => $poinPelanggaran,
        ]);

        // 2. Tambahkan poin ke siswa
        if ($poinPelanggaran > 0) {
            $siswa = $siswaModel->where('nisn', $izin['nisn'])->first();

            if ($siswa) {
                $poinSebelumnya = $siswa['poin'] ?? 0;
                $poinBaru = $poinSebelumnya + $poinPelanggaran;

                $siswaModel->update($siswa['id'], [
                    'poin' => $poinBaru
                ]);
            }
        }

        return redirect()->to('/piket/history_konfirmasi')->with('success', 'Konfirmasi berhasil disimpan.');
    }






}
