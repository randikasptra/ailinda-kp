<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PelanggaranModel;
use App\Models\SiswaModel;
use App\Models\SuratIzinModel;

class Dashboard extends BaseController
{
    protected $izinModel;
    protected $userModel;
    protected $pelanggaranModel;

    public function __construct()
    {
        $this->izinModel = new SuratIzinModel();
        $this->userModel = new UserModel();
        $this->pelanggaranModel = new PelanggaranModel();
    }

    // DASHBOARD PIKET
    public function piket()
    {
        $today = date('Y-m-d');

        $totalIzinHariIni = $this->izinModel
            ->where('DATE(waktu_keluar)', $today)
            ->countAllResults();

        $belumKembali = $this->izinModel
            ->where('status_kembali', 'belum kembali')
            ->countAllResults();

        $pelanggaranHariIni = $this->izinModel
            ->where('DATE(waktu_keluar)', $today)
            ->where('poin_pelanggaran >', 0)
            ->countAllResults();

        return view('pages/piket/piket', [
            'title' => 'Dashboard Piket',
            'totalIzinHariIni' => $totalIzinHariIni,
            'belumKembali' => $belumKembali,
            'pelanggaranHariIni' => $pelanggaranHariIni,
        ]);
    }

    // DASHBOARD BP
    public function bp()
    {
        return view('pages/bp/bp', ['title' => 'Dashboard BP']);
    }


    public function siswa()
    {
        $model = new \App\Models\SiswaModel();
        $data['siswa'] = $model->findAll();
        return view('pages/admin/siswa', $data);
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

        $totalAdmin = $this->userModel->where('role', 'admin')->countAllResults();
        $totalPelanggaran = $pelanggaranModel->countAllResults();
        $totalSiswa = $siswaModel->countAllResults();

        return view('pages/admin/dashboard', [
            'title' => 'Dashboard Admin',
            'totalAdmin' => $totalAdmin,
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