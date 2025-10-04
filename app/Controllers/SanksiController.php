<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelanggaranModel;
use App\Models\SanksiSiswaModel;

class SanksiController extends BaseController
{
    protected $pelanggaranModel;
    protected $sanksiModel;

    public function __construct()
    {
        $this->pelanggaranModel = new PelanggaranModel();
        // $this->sanksiModel = new SanksiSiswaModel();
    }

    public function index()
    {
        $data['pelanggaranList'] = $this->pelanggaranModel->findAll();

        return view('Pages/Piket/sangsi_siswa', $data);
    }

    public function store()
    {
        // Validasi input
        if (!$this->validate([
            'nis' => 'required|min_length[5]',
            'nama' => 'required|min_length[3]',
            // Tambahkan validasi lain jika diperlukan
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $postData = $this->request->getPost();

        // Data untuk tabel sanksi_siswa
        $sanksiData = [
            'nis' => $postData['nis'],
            'nism' => $postData['nism'] ?? null,
            'nama' => $postData['nama'],
            'kelas' => $postData['kelas'] ?? null,
            'no_absen' => $postData['no_absen'] ?? null,
            'jk' => $postData['jk'] ?? null,
            'jurusan' => $postData['jurusan'] ?? null,
            'tahun_ajaran' => $postData['tahun_ajaran'] ?? null,
            'poin' => $postData['poin'] ?? 0,
        ];

        // Simpan data sanksi_siswa
        $sanksiId = $this->sanksiModel->insert($sanksiData);

        if ($sanksiId) {
            // Simpan relasi pelanggaran (asumsikan ada method addPelanggaran di model)
            $pelanggaranIds = $postData['pelanggaran_ids'] ?? [];
            foreach ($pelanggaranIds as $pelId) {
                // Contoh: insert ke tabel pivot sanksi_pelanggaran
                $this->sanksiModel->addPelanggaran($sanksiId, $pelId);
            }

            // Log aktivitas jika diperlukan
            // $this->activityLogModel->save([...]);

            return redirect()->to('/sanksi/siswa')->with('success', 'Sanksi siswa berhasil ditambahkan!');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan sanksi siswa.');
    }
}