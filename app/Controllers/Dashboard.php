<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PelanggaranModel;
use App\Models\SiswaModel;
use App\Models\SuratIzinModel;
use App\Models\HistoryKonfirmasiModel;
use App\Models\ActivityLogModel; // Tambahkan model baru
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\SuratIzinMasukModel;
use App\Models\SuratIzinPelanggaranModel;

class Dashboard extends BaseController
{
    protected $izinModel;
    protected $userModel;
    protected $pelanggaranModel;
    protected $historyModel;
    protected $siswaModel;
    protected $activityLogModel;
    protected $suratIzinMasukModel;
    protected $suratIzinModel;
    protected $suratIzinPelanggaranModel;




    public function __construct()
    {
        $this->izinModel = new SuratIzinModel();
        $this->userModel = new UserModel();
        $this->pelanggaranModel = new PelanggaranModel();
        $this->historyModel = new HistoryKonfirmasiModel();
        $this->siswaModel = new SiswaModel();
        $this->suratIzinModel = new SuratIzinModel();
        $this->suratIzinMasukModel = new SuratIzinMasukModel();
        $this->pelanggaranModel = new PelanggaranModel();
        $this->suratIzinPelanggaranModel = new SuratIzinPelanggaranModel();
        $this->activityLogModel = new ActivityLogModel(); // Inisialisasi model baru
    }

    // DASHBOARD ADMIN
    public function admin()
    {
        $pelanggaranModel = new PelanggaranModel();
        $siswaModel = new SiswaModel();

        $totalUser = $this->userModel->countAllResults();
        $totalPelanggaran = $pelanggaranModel->countAllResults();
        $totalSiswa = $siswaModel->countAllResults();

        // Data untuk grafik pelanggaran berdasarkan kategori
        $pelanggaranData = $pelanggaranModel->select('kategori, COUNT(*) as jumlah')
            ->groupBy('kategori')
            ->findAll();

        // Data untuk grafik siswa berdasarkan kelas
        $siswaData = $siswaModel->select('kelas, COUNT(*) as jumlah')
            ->groupBy('kelas')
            ->findAll();

        // Ambil 5 aktivitas terbaru
        $recentActivities = $this->activityLogModel
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        return view('pages/admin/dashboard', [
            'title' => 'Dashboard Admin',
            'totalUser' => $totalUser,
            'totalPelanggaran' => $totalPelanggaran,
            'totalSiswa' => $totalSiswa,
            'pelanggaranData' => $pelanggaranData,
            'siswaData' => $siswaData,
            'recentActivities' => $recentActivities
        ]);
    }

    // DASHBOARD PIKET
    // public function piket()
    // {
    //     $today = date('Y-m-d');

    //     $izinHariIni = $this->izinModel
    //         ->like('created_at', $today)
    //         ->countAllResults();

    //     $historyHariIni = $this->historyModel
    //         ->like('updated_at', $today)
    //         ->countAllResults();

    //     $totalIzinHariIni = $izinHariIni + $historyHariIni;

    //     $belumKembali = $this->izinModel
    //         ->where('status', 'belum kembali')
    //         ->countAllResults();

    //     $pelanggaranHariIni = $this->pelanggaranModel
    //         ->like('created_at', $today)
    //         ->countAllResults();

    //     $izinTerbaru = $this->izinModel
    //         ->orderBy('created_at', 'DESC')
    //         ->limit(5)
    //         ->findAll();

    //     return view('pages/piket/piket', [
    //         'title' => 'Dashboard Piket',
    //         'totalIzinHariIni' => $totalIzinHariIni,
    //         'belumKembali' => $belumKembali,
    //         'pelanggaranHariIni' => $pelanggaranHariIni,
    //         'izinTerbaru' => $izinTerbaru
    //     ]);
    // }
public function piket()
{
    $page_keluar = $this->request->getGet('page_keluar') ?? 1;
    $page_masuk  = $this->request->getGet('page_masuk') ?? 1;

    $today = date('Y-m-d');
    $kemarin = date('Y-m-d', strtotime('-1 day'));

    // --- Surat Izin Keluar Hari Ini ---
    $suratIzin = $this->suratIzinModel
        ->where('DATE(created_at)', $today)
        ->paginate(5, 'keluar', $page_keluar);
    $pager_keluar = $this->suratIzinModel->pager;
    $total_izin_keluar = $this->suratIzinModel->pager->getTotal('keluar');

    foreach ($suratIzin as &$izin) {
        $izin['pelanggaran'] = $this->suratIzinPelanggaranModel
            ->select('surat_izin_pelanggaran.id as pivot_id, pelanggaran.jenis_pelanggaran, pelanggaran.poin, pelanggaran.id as pelanggaran_id, surat_izin_pelanggaran.catatan')
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->where('surat_izin_pelanggaran.surat_izin_id', $izin['id'])
            ->findAll();
    }

    // --- Surat Izin Masuk Hari Ini ---
    $suratIzinMasuk = $this->suratIzinMasukModel
        ->where('DATE(created_at)', $today)
        ->paginate(5, 'masuk', $page_masuk);
    $pager_masuk = $this->suratIzinMasukModel->pager;
    $total_izin_masuk = $this->suratIzinMasukModel->pager->getTotal('masuk');

    foreach ($suratIzinMasuk as &$masuk) {
        $masuk['pelanggaran'] = $this->suratIzinPelanggaranModel
            ->select('surat_izin_pelanggaran.id as pivot_id, pelanggaran.jenis_pelanggaran, pelanggaran.poin, pelanggaran.id as pelanggaran_id, surat_izin_pelanggaran.catatan')
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->where('surat_izin_pelanggaran.surat_masuk_id', $masuk['id'])
            ->findAll();
    }

    // --- Surat Izin Keluar Kemarin ---
    $suratIzinKemarin = $this->suratIzinModel
        ->select('surat_izin.*, "keluar" as type')
        ->where('DATE(created_at)', $kemarin)
        ->findAll();

    foreach ($suratIzinKemarin as &$izin) {
        $izin['pelanggaran'] = $this->suratIzinPelanggaranModel
            ->select('surat_izin_pelanggaran.id as pivot_id, pelanggaran.jenis_pelanggaran, pelanggaran.poin, pelanggaran.id as pelanggaran_id, surat_izin_pelanggaran.catatan')
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->where('surat_izin_pelanggaran.surat_izin_id', $izin['id'])
            ->findAll();
    }

    // --- Surat Izin Masuk Kemarin ---
    $suratIzinMasukKemarin = $this->suratIzinMasukModel
        ->select('surat_izin_masuk.*, "masuk" as type')
        ->where('DATE(created_at)', $kemarin)
        ->findAll();

    foreach ($suratIzinMasukKemarin as &$masuk) {
        $masuk['pelanggaran'] = $this->suratIzinPelanggaranModel
            ->select('surat_izin_pelanggaran.id as pivot_id, pelanggaran.jenis_pelanggaran, pelanggaran.poin, pelanggaran.id as pelanggaran_id, surat_izin_pelanggaran.catatan')
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->where('surat_izin_pelanggaran.surat_masuk_id', $masuk['id'])
            ->findAll();
    }

    // --- Data 7 Hari Terakhir untuk Chart ---
    $last7Days = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $last7Days[] = $date;
    }

    $weeklyDataKeluar = [];
    $weeklyDataMasuk = [];

    foreach ($last7Days as $date) {
        // Data izin keluar per hari
        $izinKeluarHariIni = $this->suratIzinModel
            ->where('DATE(created_at)', $date)
            ->countAllResults();
        $weeklyDataKeluar[] = $izinKeluarHariIni;

        // Data izin masuk per hari
        $izinMasukHariIni = $this->suratIzinMasukModel
            ->where('DATE(created_at)', $date)
            ->countAllResults();
        $weeklyDataMasuk[] = $izinMasukHariIni;
    }

    $data = [
        'surat_izin'               => $suratIzin,
        'surat_izin_masuk'         => $suratIzinMasuk,
        'surat_izin_kemarin'       => $suratIzinKemarin,
        'surat_izin_masuk_kemarin' => $suratIzinMasukKemarin,
        'pelanggaranList'          => $this->pelanggaranModel->orderBy('kategori', 'ASC')->findAll(),
        'pager_keluar'             => $pager_keluar,
        'pager_masuk'              => $pager_masuk,
        'total_izin_keluar'        => $total_izin_keluar,
        'total_izin_masuk'         => $total_izin_masuk,
        'weekly_data_keluar'       => $weeklyDataKeluar,
        'weekly_data_masuk'        => $weeklyDataMasuk,
        'last_7_days_labels'       => $last7Days,
            'title'            => 'Dashboard Piket',
    ];

    return view('pages/piket/piket', $data);
}

    // DASHBOARD BP
    public function bp()
    {
        $siswaModel = new \App\Models\SiswaModel();
        $historyModel = new \App\Models\HistoryKonfirmasiModel();

        $bulanIni = date('Y-m');
        $totalPelanggaranBulanIni = $historyModel
            ->where("DATE_FORMAT(created_at, '%Y-%m')", $bulanIni)
            ->countAllResults();

        $jumlahSiswaMendekatiDO = $siswaModel
            ->where('poin >=', 100)
            ->countAllResults();

        $topSiswa = $siswaModel
            ->orderBy('poin', 'DESC')
            ->limit(5)
            ->findAll();

        return view('pages/bp/bp', [
            'title' => 'Dashboard BP',
            'totalPelanggaranBulanIni' => $totalPelanggaranBulanIni,
            'jumlahSiswaMendekatiDO' => $jumlahSiswaMendekatiDO,
            'topSiswa' => $topSiswa
        ]);
    }

    public function hapus_lulus()
    {
        $model = new \App\Models\SiswaModel();
        $model->where('kelas', 0)->orWhere('kelas', null)->delete();
        
        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'siswa',
            'description' => 'Siswa kelas 12 dihapus (lulus)',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id') // Asumsi session menyimpan user_id
        ]);

        return redirect()->back()->with('success', 'Siswa yang sudah lulus berhasil dihapus.');
    }

    public function tambahSiswa()
    {
        $data = $this->request->getPost();
        $model = new \App\Models\SiswaModel();
        $model->save($data);

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'siswa',
            'description' => 'Siswa baru ditambahkan: ' . esc($data['nama']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id')
        ]);

        return redirect()->to('/admin/siswa')->with('success', 'Siswa ditambahkan!');
    }

    public function hapusSiswa($id)
    {
        $model = new \App\Models\SiswaModel();
        $siswa = $model->find($id);
        $model->delete($id);

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'siswa',
            'description' => 'Siswa dihapus: ' . esc($siswa['nama']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id')
        ]);

        return redirect()->to('/admin/siswa')->with('success', 'Siswa dihapus!');
    }

    public function editUser($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan.');
        }

        return view('pages/admin/editUser', [
            'title' => 'Edit User',
            'user' => $user
        ]);
    }

    public function updateUser($id)
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'user',
            'description' => 'User diperbarui: ' . esc($data['username']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id')
        ]);

        return redirect()->to('/admin/users')->with('success', 'User berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        $user = $this->userModel->find($id);
        $this->userModel->delete($id);

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'user',
            'description' => 'User dihapus: ' . esc($user['username']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id')
        ]);

        return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus!');
    }

    public function users()
    {
        $users = $this->userModel->findAll();
        return view('pages/admin/users', [
            'title' => 'Kelola Users',
            'users' => $users
        ]);
    }

    public function tambahUser()
    {
        $data = $this->request->getPost();

        if ($data) {
            $this->userModel->save([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role' => $data['role'],
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Log aktivitas
            $this->activityLogModel->save([
                'type' => 'user',
                'description' => 'User baru ditambahkan: ' . esc($data['username']),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('user_id')
            ]);

            return redirect()->to('admin/users')->with('success', 'User berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan user.');
    }

    public function importCSV()
    {
        $file = $this->request->getFile('csv_file');

        if (!$file || !$file->isValid()) {
            session()->setFlashdata('error', 'File tidak valid atau tidak ditemukan.');
            return redirect()->to('/admin/siswa');
        }

        $ext = strtolower($file->getClientExtension());
        $siswaModel = new SiswaModel();
        $dataToInsert = [];
        $nisInFile = [];

        try {
            if ($ext === 'csv') {
                $handle = fopen($file->getTempName(), 'r');
                $headerFound = false;
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    if (isset($row[0]) && strtoupper(trim($row[0])) === 'NO') {
                        $headerFound = true;
                        break;
                    }
                }

                if (!$headerFound) {
                    session()->setFlashdata('error', 'Header CSV tidak sesuai format.');
                    return redirect()->to('/admin/siswa');
                }

                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    $kelas   = trim($row[1] ?? '');
                    $noAbsen = (int)($row[2] ?? null);
                    $nama    = trim($row[3] ?? '');
                    $jk      = trim($row[4] ?? '');
                    $nis     = trim($row[5] ?? '');
                    $tahun   = "2025/2026";

                    if (!$nis) continue;
                    if (in_array($nis, $nisInFile)) continue;
                    $nisInFile[] = $nis;

                    if ($siswaModel->where('nis', $nis)->first()) continue;

                    $dataToInsert[] = [
                        'nis'          => $nis,
                        'nama'         => $nama,
                        'kelas'        => $kelas,
                        'no_absen'     => $noAbsen,
                        'jk'           => $jk,
                        'jurusan'      => 'SOSHUM',
                        'tahun_ajaran' => $tahun,
                        'poin'         => 0,
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s'),
                    ];
                }
                fclose($handle);

            } else {
                $spreadsheet = IOFactory::load($file->getTempName());
                $sheet = $spreadsheet->getSheetByName('DAFTAR SISWA');
                if (!$sheet) {
                    $sheet = $spreadsheet->getActiveSheet();
                }
                $rows = $sheet->toArray();

                $startRow = null;
                foreach ($rows as $i => $row) {
                    if (isset($row[0]) && strtoupper(trim($row[0])) === 'NO') {
                        $startRow = $i + 1;
                        break;
                    }
                }

                if ($startRow === null) {
                    session()->setFlashdata('error', 'Header Excel tidak sesuai format.');
                    return redirect()->to('/admin/siswa');
                }

                for ($i = $startRow; $i < count($rows); $i++) {
                    $row = $rows[$i];

                    $kelas   = trim($row[2] ?? '');
                    $noAbsen = (int)($row[3] ?? null);
                    $nama    = trim($row[4] ?? '');
                    $jk      = trim($row[5] ?? '');
                    $nis     = trim($row[6] ?? '');
                    $nism    = trim($row[7] ?? '');
                    $tahun   = "2025/2026";

                    if (!$nis) continue;
                    if (in_array($nis, $nisInFile)) continue;
                    $nisInFile[] = $nis;

                    if ($siswaModel->where('nis', $nis)->first()) continue;

                    $dataToInsert[] = [
                        'nis'          => $nis,
                        'nism'         => $nism,
                        'nama'         => $nama,
                        'kelas'        => $kelas,
                        'no_absen'     => $noAbsen,
                        'jk'           => $jk,
                        'jurusan'      => 'SOSHUM',
                        'tahun_ajaran' => $tahun,
                        'poin'         => 0,
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s'),
                    ];
                }
            }

            if (!empty($dataToInsert)) {
                $siswaModel->insertBatch($dataToInsert);
                
                // Log aktivitas untuk setiap siswa yang diimpor
                foreach ($dataToInsert as $data) {
                    $this->activityLogModel->save([
                        'type' => 'siswa',
                        'description' => 'Siswa baru diimpor: ' . esc($data['nama']),
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => session()->get('user_id')
                    ]);
                }

                session()->setFlashdata('success', count($dataToInsert) . ' data siswa berhasil diimpor.');
            } else {
                session()->setFlashdata('warning', 'Tidak ada data baru untuk diimpor.');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/admin/siswa');
    }
}