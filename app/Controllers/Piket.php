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
    protected $pelanggaranModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->izinModel = new SuratIzinModel();
        $this->pelanggaranModel = new PelanggaranModel();
    }


    public function izinMasukForm()
    {
        $siswaModel = new SiswaModel();
        $pelanggaranModel = new PelanggaranModel();

        $data = [
            'title' => 'Surat Izin Masuk',
            'siswa' => $siswaModel->findAll(),
            'pelanggaran' => $pelanggaranModel->findAll(),
        ];

        return view('pages/piket/izin_masuk_form', $data);
    }

    public function izinMasukSubmit()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nisn' => $this->request->getPost('nisn'),
            'kelas' => $this->request->getPost('kelas'),
            'jurusan' => $this->request->getPost('jurusan'),
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'alasan' => $this->request->getPost('alasan'),
            'tindak_lanjut' => $this->request->getPost('tindak_lanjut'),
            'poin' => $this->request->getPost('poin'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->izinMasukModel->insert($data);

        $lastId = $this->izinMasukModel->insertID(); // ID terakhir

        // Redirect ke halaman cetak
        return redirect()->to(base_url('piket/izin-masuk/cetak/' . $lastId));
    }

    public function cetakIzinMasuk($id)
    {
        $izin = $this->izinMasukModel->find($id);

        if (!$izin) {
            return redirect()->back()->with('error', 'Data izin masuk tidak ditemukan.');
        }

        return view('pages/piket/izin_masuk_cetak', [
            'title' => 'Cetak Surat Izin Masuk',
            'izin' => $izin
        ]);
    }

    public function submitIzinMasuk()
    {
        $request = $this->request;
        $pelanggaranModel = new \App\Models\PelanggaranModel();
        $poin = $request->getPost('poin');

        // Cari nama pelanggaran berpiketarkan poin
        $pelanggaran = $pelanggaranModel->where('poin', $poin)->first();

        $data = [
            'nama' => $request->getPost('nama'),
            'nisn' => $request->getPost('nisn'),
            'kelas' => $request->getPost('kelas'),
            'jurusan' => $request->getPost('jurusan'),
            'tahun_ajaran' => $request->getPost('tahun_ajaran'),
            'alasan' => $request->getPost('alasan'),
            'tindak_lanjut' => $request->getPost('tindak_lanjut'),
            'poin' => $poin,
            'nama_pelanggaran' => $pelanggaran['nama_pelanggaran'] ?? 'Tidak Diketahui',
        ];

        return view('pages/piket/surat_izin_masuk', $data);
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

    // Bawa flashdata agar ditampilkan di halaman cetak
    session()->setFlashdata('success', 'Surat izin berhasil dibuat.');

    // Redirect ke halaman cetak
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

        $pelanggarans = $pelanggaranModel->findAll();

        $data = [
            'title' => 'Konfirmasi Kembali',
            'izinList' => $izinBelumKembali,
            'pelanggarans' => $pelanggarans, // pastikan cocok dengan Alpine.js
            'belumKembali' => count($izinBelumKembali)
        ];

        return view('pages/piket/konfirmasi_kembali', $data);
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
    $izinModel = new \App\Models\SuratIzinModel();
    $pelanggaranModel = new \App\Models\PelanggaranModel();
    $siswaModel = new \App\Models\SiswaModel();
    $historyModel = new \App\Models\HistoryKonfirmasiModel();
    $db = \Config\Database::connect();

    $izinId = $this->request->getPost('izin_id');
    $waktuKembaliSiswa = $this->request->getPost('waktu_kembali_siswa');
    $pelanggaranIds = $this->request->getPost('pelanggaran_id') ?? [];

    $izin = $izinModel->find($izinId);
    if (!$izin) {
        return redirect()->back()->with('error', 'Data izin tidak ditemukan.');
    }

    // Hitung total poin pelanggaran (per kejadian)
    $totalPoin = 0;
    foreach ($pelanggaranIds as $pid) {
        $pel = $pelanggaranModel->find($pid);
        if ($pel) {
            $totalPoin += $pel['poin'];
        }
    }

    // Update data izin
    $izinModel->update($izinId, [
        'waktu_kembali_siswa' => $waktuKembaliSiswa,
        'status' => 'sudah kembali',
        'poin_pelanggaran' => $totalPoin
    ]);

    // Update poin siswa di tabel siswa
    $siswa = $siswaModel
        ->where('nama', $izin['nama'])
        ->where('kelas', $izin['kelas'])
        ->first();

    if ($siswa) {
        $newPoin = $siswa['poin'] + $totalPoin;
        $siswaModel->update($siswa['id'], [
            'poin' => $newPoin,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Simpan ke history_konfirmasi
    $historyId = $historyModel->insert([
        'izin_id' => $izinId,
        'nama' => $izin['nama'],
        'kelas' => $izin['kelas'],
        'waktu_keluar' => $izin['waktu_keluar'],
        'waktu_kembali' => $izin['waktu_kembali'],
        'waktu_kembali_siswa' => $waktuKembaliSiswa,
        'poin_pelanggaran' => $totalPoin,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);

    // Simpan pelanggaran yang dipilih ke pivot
    foreach ($pelanggaranIds as $pid) {
        $db->table('history_konfirmasi_pelanggaran')->insert([
            'history_konfirmasi_id' => $historyId,
            'pelanggaran_id' => $pid
        ]);
    }

    return redirect()->back()->with('success', 'Konfirmasi berhasil disimpan dan poin siswa ditambahkan!');
}



}
