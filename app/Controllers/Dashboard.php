<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PelanggaranModel;
use App\Models\SiswaModel;
use App\Models\SuratIzinModel;
use App\Models\HistoryKonfirmasiModel;

class Dashboard extends BaseController
{
    protected $izinModel;
    protected $userModel;
    protected $pelanggaranModel;
    protected $historyModel;

    public function __construct()
    {
        $this->izinModel = new SuratIzinModel();
        $this->userModel = new UserModel();
        $this->pelanggaranModel = new PelanggaranModel();
        $this->historyModel = new HistoryKonfirmasiModel(); // ✅ Fix properti model
    }

    // DASHBOARD PIKET
    public function piket()
    {
        $today = date('Y-m-d');

        // Total surat izin yang dibuat hari ini
        $izinHariIni = $this->izinModel
            ->like('created_at', $today)
            ->countAllResults();

        // Total surat izin yang dikonfirmasi kembali hari ini
        $historyHariIni = $this->historyModel
            ->like('updated_at', $today)
            ->countAllResults();

        // Total surat izin hari ini = surat_izin + history_konfirmasi hari ini
        $totalIzinHariIni = $izinHariIni + $historyHariIni;

        // Total siswa yang belum kembali (masih berstatus belum kembali)
        $belumKembali = $this->izinModel
            ->where('status', 'belum kembali')
            ->countAllResults();

        // Total pelanggaran hari ini
        $pelanggaranHariIni = $this->pelanggaranModel
            ->like('created_at', $today)
            ->countAllResults();

        // Ambil 5 surat izin terbaru
        $izinTerbaru = $this->izinModel
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        return view('pages/piket/piket', [
            'title' => 'Dashboard Piket',
            'totalIzinHariIni' => $totalIzinHariIni,
            'belumKembali' => $belumKembali,
            'pelanggaranHariIni' => $pelanggaranHariIni,
            'izinTerbaru' => $izinTerbaru
        ]);
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
            ->where('poin >=', 180)
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


    public function siswa()
    {
        $model = new \App\Models\SiswaModel();
        $data['siswa'] = $model->findAll();
        return view('pages/admin/siswa', $data);
    }

    public function update_kelas()
    {
        $model = new \App\Models\SiswaModel();

        // Ambil semua siswa
        $siswaList = $model->findAll();

        foreach ($siswaList as $siswa) {
            $kelas = (int) $siswa['kelas'];

            // Naik kelas jika 10 atau 11, null-kan jika 12
            if ($kelas === 10) {
                $model->update($siswa['id'], ['kelas' => 11]);
            } elseif ($kelas === 11) {
                $model->update($siswa['id'], ['kelas' => 12]);
            } elseif ($kelas === 12) {
                $model->update($siswa['id'], ['kelas' => null]);
            }
        }

        return redirect()->back()->with('success', 'Kelas siswa berhasil diperbarui.');
    }

    public function hapus_lulus()
    {
        $model = new \App\Models\SiswaModel();

        // Hapus siswa yang kelasnya 0 atau null
        $model->where('kelas', 0)->orWhere('kelas', null)->delete();

        return redirect()->back()->with('success', 'Siswa yang sudah lulus berhasil dihapus.');
    }

    public function tambahSiswa()
    {
        $data = $this->request->getPost();
        $model = new \App\Models\SiswaModel();
        $model->save($data);
        return redirect()->to('/admin/siswa')->with('success', 'Siswa ditambahkan!');
    }

    public function detailSiswa($id)
    {
        $model = new \App\Models\SiswaModel();
        $data['siswa'] = $model->find($id);
        return view('pages/admin/detail_siswa', $data);
    }

    public function hapusSiswa($id)
    {
        $model = new \App\Models\SiswaModel();
        $model->delete($id);
        return redirect()->to('/admin/siswa')->with('success', 'Siswa dihapus!');
    }

    // DASHBOARD ADMIN
    public function admin()
{
    $pelanggaranModel = new PelanggaranModel();
    $siswaModel = new SiswaModel();

    $totalUser = $this->userModel->countAllResults(); // dihitung semua user
    $totalPelanggaran = $pelanggaranModel->countAllResults();
    $totalSiswa = $siswaModel->countAllResults();

    return view('pages/admin/dashboard', [
        'title' => 'Dashboard Admin',
        'totalUser' => $totalUser,
        'totalPelanggaran' => $totalPelanggaran,
        'totalSiswa' => $totalSiswa
    ]);
}

    // Tampilkan form edit user
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

    public function editPelanggaran($id)
    {

        $data['title'] = 'Edit Pelanggaran';
        $data['pelanggaran'] = $this->pelanggaranModel->find($id);

        if (!$data['pelanggaran']) {
            return redirect()->to('/admin/pelanggaran')->with('error', 'Data tidak ditemukan.');
        }

        return view('pages/admin/edit_pelanggaran', $data);
    }

    public function updatePelanggaran($id)
    {
        $data = $this->request->getPost();

        $this->pelanggaranModel->update($id, [
            'jenis_pelanggaran' => $data['jenis_pelanggaran'],
            'poin' => $data['poin']
        ]);

        return redirect()->to('/admin/pelanggaran')->with('success', 'Data pelanggaran berhasil diperbarui.');
    }
    public function updateUser($id)
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Jika password diisi, update
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/admin/users')->with('success', 'User berhasil diperbarui!');
    }

    // Proses hapus user
    public function deleteUser($id)
    {
        $this->userModel->delete($id);
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
            return redirect()->to('admin/users')->with('success', 'User berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan user.');
    }

    public function pelanggaran()
    {
        $model = new PelanggaranModel();
        $data = [
            'title' => 'Kelola Pelanggaran',
            'pelanggaran' => $model->findAll()
        ];
        return view('pages/admin/pelanggaran', $data);
    }

    public function editSiswa($id)
    {
        $model = new SiswaModel();
        $siswa = $model->find($id);

        if (!$siswa) {
            return redirect()->to('/admin/siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('pages/admin/edit_siswa', [
            'title' => 'Edit Data Siswa',
            'siswa' => $siswa
        ]);
    }

    public function updateSiswa($id)
    {
        $model = new SiswaModel();
        $data = $this->request->getPost();

        $model->update($id, $data);
        return redirect()->to('/admin/siswa')->with('success', 'Data siswa berhasil diperbarui!');
    }

  public function importCSV()
{
    $file = $this->request->getFile('csv_file');

    if ($file->isValid() && $file->getClientExtension() === 'csv') {
        $handle = fopen($file->getTempName(), 'r');

        // Skip header
        fgetcsv($handle);

        $siswaModel = new \App\Models\SiswaModel();

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $data = [
                'nisn'          => $row[0],
                'nama'          => $row[1],
                'kelas'         => (int)$row[2],
                'tahun_ajaran'  => $row[3],
                'jurusan'       => strtoupper($row[4]), // SOSHUM / SAINTEK / BAHASA
                'poin'          => 0,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            $siswaModel->insert($data);
        }

        fclose($handle);
        session()->setFlashdata('success', 'Data siswa berhasil diimpor.');
    } else {
        session()->setFlashdata('error', 'File tidak valid atau tidak ditemukan.');
    }

    return redirect()->to('/admin/siswa');
}




    public function tambahPelanggaran()
    {
        $model = new PelanggaranModel();
        $data = $this->request->getPost();

        if ($data) {
            $model->save($data);
            return redirect()->to('/admin/pelanggaran')->with('success', 'Pelanggaran berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan pelanggaran.');
    }

    public function hapusPelanggaran($id)
    {
        $model = new PelanggaranModel();
        $model->delete($id);
        return redirect()->to('/admin/pelanggaran')->with('success', 'Pelanggaran berhasil dihapus!');
    }
}