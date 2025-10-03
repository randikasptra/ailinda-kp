<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratIzinModel;
use App\Models\SuratIzinMasukModel;
use App\Models\SuratIzinPelanggaranModel;

class LaporanAdminController extends BaseController
{
    public function index()
    {
        $izinKeluarModel   = new SuratIzinModel();
        $izinMasukModel    = new SuratIzinMasukModel();
        $pelanggaranModel  = new SuratIzinPelanggaranModel();

        // --- Izin Keluar + pelanggaran ---
        $izinKeluar = $izinKeluarModel
            ->select("
                surat_izin.id,
                surat_izin.nama,
                surat_izin.nisn,
                surat_izin.kelas,
                surat_izin.alasan,
                surat_izin.waktu_keluar,
                surat_izin.waktu_kembali,
                surat_izin.created_at,
                GROUP_CONCAT(pelanggaran.jenis_pelanggaran SEPARATOR ', ') as pelanggaran_list,
                COALESCE(SUM(pelanggaran.poin),0) as total_poin
            ")
            ->join('surat_izin_pelanggaran', 'surat_izin_pelanggaran.surat_izin_id = surat_izin.id', 'left')
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->groupBy('surat_izin.id')
            ->orderBy('surat_izin.created_at', 'DESC')
            ->findAll();

        // --- Izin Masuk + pelanggaran ---
        $izinMasuk = $izinMasukModel
            ->select("
                surat_izin_masuk.id,
                surat_izin_masuk.nama,
                surat_izin_masuk.nisn,
                surat_izin_masuk.kelas,
                surat_izin_masuk.alasan_terlambat,
                surat_izin_masuk.tindak_lanjut,
                surat_izin_masuk.created_at,
                GROUP_CONCAT(pelanggaran.jenis_pelanggaran SEPARATOR ', ') as pelanggaran_list,
                COALESCE(SUM(pelanggaran.poin),0) as total_poin
            ")
            ->join('surat_izin_pelanggaran', 'surat_izin_pelanggaran.surat_masuk_id = surat_izin_masuk.id', 'left')
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->groupBy('surat_izin_masuk.id')
            ->orderBy('surat_izin_masuk.created_at', 'DESC')
            ->findAll();

        // --- Semua Pelanggaran Detail ---
        $pelanggaran = $pelanggaranModel
            ->select("
                surat_izin_pelanggaran.*,
                pelanggaran.jenis_pelanggaran,
                pelanggaran.kategori,
                pelanggaran.poin,
                surat_izin.nama as nama_siswa_keluar,
                surat_izin_masuk.nama as nama_siswa_masuk
            ")
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->join('surat_izin', 'surat_izin.id = surat_izin_pelanggaran.surat_izin_id', 'left')
            ->join('surat_izin_masuk', 'surat_izin_masuk.id = surat_izin_pelanggaran.surat_masuk_id', 'left')
            ->orderBy('surat_izin_pelanggaran.created_at', 'DESC')
            ->findAll();

        $data = [
            'izinKeluar'   => $izinKeluar,
            'izinMasuk'    => $izinMasuk,
            'pelanggaran'  => $pelanggaran,
        ];

        return view('pages/admin/laporan', $data);
    }
}
