<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratIzinModel;
use App\Models\SuratIzinMasukModel;
use App\Models\PelanggaranModel;
use App\Models\SuratIzinPelanggaranModel;
use App\Models\SiswaModel;

class SuratIzinRekapanController extends BaseController
{
    protected $suratIzinModel;
    protected $suratIzinMasukModel;
    protected $pelanggaranModel;
    protected $suratIzinPelanggaranModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->suratIzinModel            = new SuratIzinModel();
        $this->suratIzinMasukModel       = new SuratIzinMasukModel();
        $this->pelanggaranModel          = new PelanggaranModel();
        $this->suratIzinPelanggaranModel = new SuratIzinPelanggaranModel();
        $this->siswaModel                = new SiswaModel();
    }

    public function index()
    {
        // --- Surat Izin Keluar ---
        $suratIzin = $this->suratIzinModel
            ->select('surat_izin.*, GROUP_CONCAT(pelanggaran.jenis_pelanggaran) as pelanggaran_nama')
            ->join('surat_izin_pelanggaran', 'surat_izin_pelanggaran.surat_izin_id = surat_izin.id', 'left')
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->groupBy('surat_izin.id')
            ->findAll();

        foreach ($suratIzin as &$izin) {
            $izin['pelanggaran'] = $this->suratIzinPelanggaranModel
                ->select('surat_izin_pelanggaran.id as pivot_id, pelanggaran.jenis_pelanggaran, pelanggaran.poin, surat_izin_pelanggaran.catatan')
                ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
                ->where('surat_izin_pelanggaran.surat_izin_id', $izin['id'])
                ->findAll();
        }

        // --- Surat Izin Masuk ---
        $suratIzinMasuk = $this->suratIzinMasukModel
            ->select('surat_izin_masuk.*')
            ->findAll();

        foreach ($suratIzinMasuk as &$masuk) {
            $masuk['pelanggaran'] = $this->suratIzinPelanggaranModel
                ->select('surat_izin_pelanggaran.id as pivot_id, pelanggaran.jenis_pelanggaran, pelanggaran.poin, surat_izin_pelanggaran.catatan')
                ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
                ->where('surat_izin_pelanggaran.surat_masuk_id', $masuk['id'])
                ->findAll();
        }

        $data = [
            'surat_izin'       => $suratIzin,
            'surat_izin_masuk' => $suratIzinMasuk,
            'pelanggaranList'  => $this->pelanggaranModel->orderBy('kategori', 'ASC')->findAll(),
        ];

        return view('pages/piket/izin_rekapan', $data);
    }

    public function storePelanggaran($id = null)
    {
        $suratIzinId     = $this->request->getPost('surat_izin_id') ?? $id;
        $type            = $this->request->getPost('type');
        $pelanggaranIds  = $this->request->getPost('pelanggaran_ids');
        $catatan         = $this->request->getPost('keterangan');

        if (!$suratIzinId || empty($pelanggaranIds) || !$type) {
            return redirect()->back()->with('error', 'Data tidak lengkap!');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Cari surat izin sesuai type
        $izin = $type === 'masuk'
            ? $this->suratIzinMasukModel->find($suratIzinId)
            : $this->suratIzinModel->find($suratIzinId);

        if (!$izin) {
            return redirect()->back()->with('error', 'Surat izin tidak ditemukan!');
        }

        $nisn = $izin['nisn'] ?? null;
        $totalTambahPoin = 0;

        foreach ($pelanggaranIds as $pid) {
            $pel = $this->pelanggaranModel->find($pid);
            if (!$pel) {
                continue; // skip kalau pelanggaran tidak valid
            }

            $poin = $pel['poin'] ?? 0;

            $dataInsert = [
                'pelanggaran_id' => $pid,
                'catatan'        => $catatan,
            ];

            if ($type === 'masuk') {
                $dataInsert['surat_masuk_id'] = $suratIzinId;
            } else {
                $dataInsert['surat_izin_id'] = $suratIzinId;
            }

            $this->suratIzinPelanggaranModel->insert($dataInsert);

            $totalTambahPoin += $poin;
        }

        // Update poin siswa
        if ($nisn && $totalTambahPoin > 0) {
            $this->siswaModel->where('nis', $nisn)
                ->set('poin', 'poin + ' . $totalTambahPoin, false)
                ->update();
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menambahkan pelanggaran.');
        }

        return redirect()->back()->with('success', 'Pelanggaran berhasil ditambahkan dan poin siswa terupdate.');
    }


    public function deleteIzinMasuk($id)
    {
        $izinMasukModel = new \App\Models\SuratIzinMasukModel();
        $izin = $izinMasukModel->find($id);

        if ($izin) {
            $izinMasukModel->delete($id);
            return redirect()->back()->with('success', 'Surat izin masuk berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    public function deleteIzin($id)
    {
        $izinModel = new \App\Models\SuratIzinModel();
        $izin = $izinModel->find($id);

        if ($izin) {
            $izinModel->delete($id);
            return redirect()->back()->with('success', 'Surat izin berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    
public function deleteAllPelanggaran($izinId)
{
    $db = \Config\Database::connect();
    $db->transStart();

    // Ambil semua pelanggaran dari surat izin
    $pelanggaranList = $this->suratIzinPelanggaranModel
        ->select('surat_izin_pelanggaran.*, pelanggaran.poin, 
                 surat_izin.nisn as nisn_keluar, surat_izin_masuk.nisn as nisn_masuk')
        ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
        ->join('surat_izin', 'surat_izin.id = surat_izin_pelanggaran.surat_izin_id', 'left')
        ->join('surat_izin_masuk', 'surat_izin_masuk.id = surat_izin_pelanggaran.surat_masuk_id', 'left')
        ->where('surat_izin_pelanggaran.surat_izin_id', $izinId)
        ->orWhere('surat_izin_pelanggaran.surat_masuk_id', $izinId)
        ->findAll();

    if (empty($pelanggaranList)) {
        return redirect()->back()->with('error', 'Tidak ada pelanggaran untuk dihapus.');
    }

    // Total poin yang harus dikurangi
    $totalPoin = 0;
    $nisn = null;

    foreach ($pelanggaranList as $p) {
        $totalPoin += (int) ($p['poin'] ?? 0);
        $nisn = $p['nisn_keluar'] ?? $p['nisn_masuk'];
    }

    // Hapus semua pelanggaran
    $this->suratIzinPelanggaranModel
        ->where('surat_izin_id', $izinId)
        ->orWhere('surat_masuk_id', $izinId)
        ->delete();

    // Update poin siswa
    if ($nisn && $totalPoin > 0) {
        $siswa = $this->siswaModel->where('nis', $nisn)->first();
        if ($siswa) {
            $newPoin = max(0, ($siswa['poin'] ?? 0) - $totalPoin);
            $this->siswaModel->where('nis', $nisn)->set('poin', $newPoin)->update();
        }
    }

    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->back()->with('error', 'Gagal menghapus semua pelanggaran.');
    }

    return redirect()->back()->with('success', 'Semua pelanggaran berhasil dihapus.');
}

    
}
