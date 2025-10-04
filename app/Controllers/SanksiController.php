<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\PelanggaranModel;
use App\Models\SanksiSiswaModel;

class SanksiController extends BaseController
{
    protected $siswaModel;
    protected $pelanggaranModel;
    protected $sanksiModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->pelanggaranModel = new PelanggaranModel();
        $this->sanksiModel = new SanksiSiswaModel();
    }

    // =======================
    // HALAMAN INPUT SANKSI
    // =======================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $nis = $this->request->getGet('nis');
        $siswa = null;
        $siswaList = [];

        $data['pelanggaranList'] = $this->pelanggaranModel->findAll();

        if ($keyword) {
            $siswaList = $this->siswaModel
                ->like('nama', $keyword)
                ->orLike('nis', $keyword)
                ->findAll();
        }

        if ($nis) {
            $siswa = $this->siswaModel->where('nis', $nis)->first();
        } elseif (count($siswaList) === 1) {
            $siswa = $siswaList[0];
        }

        return view('Pages/Piket/sangsi_siswa', [
            'keyword'   => $keyword,
            'siswaList' => $siswaList,
            'siswa'     => $siswa,
            'pelanggaranList' => $data['pelanggaranList'],
            'title' => 'Laporan Sanksi Siswa',

        ]);
    }

    public function storeSiswa()
    {
        $data = $this->request->getPost();
        $siswaModel = new SiswaModel();

        // Validasi sederhana
        if (!$this->validate([
            'nis'          => 'required|is_unique[siswa.nis]',
            'nama'         => 'required',
            'kelas'        => 'required',
            'no_absen'     => 'required|integer',
            'jk'           => 'required|in_list[L,P]',
            'tahun_ajaran' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data siswa baru
        $siswaModel->insert([
            'nis'          => $data['nis'],
            'nama'         => $data['nama'],
            'kelas'        => $data['kelas'],
            'no_absen'     => $data['no_absen'],
            'jk'           => $data['jk'],
            'tahun_ajaran' => $data['tahun_ajaran'],
            'poin'         => 0, // default
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        // Log aktivitas
       

        return redirect()->back()->with('success', 'Siswa baru berhasil ditambahkan!');
    }

    // =======================
    // SIMPAN DATA SANKSI SISWA
    // =======================
    public function store()
    {
        if (!$this->validate([
            'nis' => 'required',
            'pelanggaran_ids' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $post = $this->request->getPost();
        // Ambil data siswa berdasarkan NIS
        $siswa = $this->siswaModel->where('nis', $post['nis'])->first();
        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }
        $pelanggaranIds = $post['pelanggaran_ids'] ?? [];
        $totalPoin = 0;
        foreach ($pelanggaranIds as $pelId) {
            $pel = $this->pelanggaranModel->find($pelId);
            if (!$pel) continue;
            // Simpan ke tabel sanksi_siswa
            $this->sanksiModel->insert([
                'siswa_id' => $siswa['id'],
                'pelanggaran_id' => $pel['id'],
                'tanggal_pelanggaran' => date('Y-m-d'),
                'poin_didapat' => $pel['poin'],
                'keterangan' => $post['keterangan'] ?? null,
            ]);
            $totalPoin += $pel['poin'];
        }
        // Update poin total siswa
        $this->siswaModel->update($siswa['id'], [
            'poin' => $siswa['poin'] + $totalPoin,
        ]);
        return redirect()->to('/piket/sangsi_siswa')->with('success', 'Sanksi siswa berhasil ditambahkan!');
    }
}