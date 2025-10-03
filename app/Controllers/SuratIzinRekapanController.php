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
        $this->suratIzinModel = new SuratIzinModel();
        $this->suratIzinMasukModel = new SuratIzinMasukModel();
        $this->pelanggaranModel = new PelanggaranModel();
        $this->suratIzinPelanggaranModel = new SuratIzinPelanggaranModel();
        $this->siswaModel = new SiswaModel();
    }
    public function index()
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
        ];

        return view('pages/piket/izin_rekapan', $data);
    }




    private function autoDeleteOldData()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        // --- Hapus Surat Izin Keluar Lama ---
        $oldKeluar = $this->suratIzinModel
            ->where('DATE(surat_izin.created_at) <', date('Y-m-d'))
            ->findAll();

        foreach ($oldKeluar as $izin) {
            $this->deleteAllPelanggaranInternal($izin['id'], 'keluar');
            $this->suratIzinModel->delete($izin['id']);
        }

        // --- Hapus Surat Izin Masuk Lama ---
        $oldMasuk = $this->suratIzinMasukModel
            ->where('DATE(surat_izin_masuk.created_at) <', date('Y-m-d'))
            ->findAll();

        foreach ($oldMasuk as $izin) {
            $this->deleteAllPelanggaranInternal($izin['id'], 'masuk');
            $this->suratIzinMasukModel->delete($izin['id']);
        }

        $db->transComplete();
    }

    private function deleteAllPelanggaranInternal($izinId, $type)
    {
        // Ambil semua pelanggaran dari surat izin
        $pelanggaranList = $this->suratIzinPelanggaranModel
            ->select('surat_izin_pelanggaran.*, pelanggaran.poin,
                     surat_izin.nisn as nisn_keluar, surat_izin_masuk.nisn as nisn_masuk')
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->join('surat_izin', 'surat_izin.id = surat_izin_pelanggaran.surat_izin_id', 'left')
            ->join('surat_izin_masuk', 'surat_izin_masuk.id = surat_izin_pelanggaran.surat_masuk_id', 'left')
            ->where($type === 'keluar' ? 'surat_izin_pelanggaran.surat_izin_id' : 'surat_izin_pelanggaran.surat_masuk_id', $izinId)
            ->findAll();
        
        if (empty($pelanggaranList)) {
            return;
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
            ->where($type === 'keluar' ? 'surat_izin_id' : 'surat_masuk_id', $izinId)
            ->delete();
        
        // Update poin siswa
        if ($nisn && $totalPoin > 0) {
            $siswa = $this->siswaModel->where('nis', $nisn)->first();
            if ($siswa) {
                $newPoin = max(0, ($siswa['poin'] ?? 0) - $totalPoin);
                $this->siswaModel->where('nis', $nisn)->set('poin', $newPoin)->update();
            }
        }
    }

    public function storePelanggaran($id = null)
    {
        $suratIzinId = $this->request->getPost('surat_izin_id') ?? $id;
        $type = $this->request->getPost('type');
        $pelanggaranIds = $this->request->getPost('pelanggaran_ids');
        $catatan = $this->request->getPost('keterangan');
        $mode = $this->request->getPost('mode') ?? 'add';
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
        if ($mode === 'edit') {
            // Hapus semua pelanggaran lama dulu (kurangi poin)
            $this->deleteAllPelanggaran($suratIzinId);
        }
        $totalTambahPoin = 0;
        foreach ($pelanggaranIds as $pid) {
            $pel = $this->pelanggaranModel->find($pid);
            if (!$pel) {
                continue; // skip kalau pelanggaran tidak valid
            }
            $poin = $pel['poin'] ?? 0;
            $dataInsert = [
                'pelanggaran_id' => $pid,
                'catatan' => $catatan,
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
            return redirect()->back()->with('error', 'Gagal menyimpan pelanggaran.');
        }
        $msg = $mode === 'edit' ? 'Pelanggaran berhasil diupdate dan poin siswa terupdate.' : 'Pelanggaran berhasil ditambahkan dan poin siswa terupdate.';
        return redirect()->back()->with('success', $msg);
    }
    public function deleteIzinMasuk($id)
    {
        $izinMasukModel = new \App\Models\SuratIzinMasukModel();
        $izin = $izinMasukModel->find($id);
        if ($izin) {
            // Hapus pelanggaran dulu
            $this->suratIzinPelanggaranModel->where('surat_masuk_id', $id)->delete();
            // Update poin siswa
            if (isset($izin['nisn'])) {
                $this->siswaModel->where('nis', $izin['nisn'])->set('poin', 0)->update(); // Sesuaikan logika
            }
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
            // Hapus pelanggaran dulu
            $this->suratIzinPelanggaranModel->where('surat_izin_id', $id)->delete();
            // Update poin siswa
            if (isset($izin['nisn'])) {
                $this->siswaModel->where('nis', $izin['nisn'])->set('poin', 0)->update(); // Sesuaikan logika
            }
            $izinModel->delete($id);
            return redirect()->back()->with('success', 'Surat izin berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }
    
    public function deletePelanggaran($pivotId)
    {
        $pivot = $this->suratIzinPelanggaranModel->find($pivotId);
        if (!$pivot) {
            return redirect()->back()->with('error', 'Pelanggaran tidak ditemukan');
        }
        $pelanggaran = $this->pelanggaranModel->find($pivot['pelanggaran_id']);
        if ($pelanggaran) {
            $poin = $pelanggaran['poin'] ?? 0;
            $nisn = null;
            if ($pivot['surat_izin_id']) {
                $izin = $this->suratIzinModel->find($pivot['surat_izin_id']);
                $nisn = $izin['nisn'] ?? null;
            } elseif ($pivot['surat_masuk_id']) {
                $izin = $this->suratIzinMasukModel->find($pivot['surat_masuk_id']);
                $nisn = $izin['nisn'] ?? null;
            }
            if ($nisn && $poin > 0) {
                $this->siswaModel->where('nis', $nisn)
                    ->set('poin', 'poin - ' . $poin, false)
                    ->update();
            }
        }
        $this->suratIzinPelanggaranModel->delete($pivotId);
        return redirect()->back()->with('success', 'Pelanggaran berhasil dihapus');
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