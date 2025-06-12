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

    public function __construct()
    {
        $this->izinModel = new SuratIzinModel();
        $this->userModel = new UserModel();
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