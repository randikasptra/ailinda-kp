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

    // ambil parameter date range
    $startDate = $this->request->getGet('start_date');
    $endDate   = $this->request->getGet('end_date');

    if ($endDate) {
        // supaya jam terakhir tetap ikut
        $endDate = date('Y-m-d 23:59:59', strtotime($endDate));
    }
    if ($startDate) {
        $startDate = date('Y-m-d 00:00:00', strtotime($startDate));
    }

    // Query Izin Keluar
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
        ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left');

    if ($startDate) {
        $izinKeluar->where('surat_izin.created_at >=', $startDate);
    }
    if ($endDate) {
        $izinKeluar->where('surat_izin.created_at <=', $endDate);
    }

    $izinKeluar = $izinKeluar->groupBy('surat_izin.id')
                             ->orderBy('surat_izin.created_at', 'DESC')
                             ->findAll();

    // Query Izin Masuk
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
        ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left');

    if ($startDate) {
        $izinMasuk->where('surat_izin_masuk.created_at >=', $startDate);
    }
    if ($endDate) {
        $izinMasuk->where('surat_izin_masuk.created_at <=', $endDate);
    }

    $izinMasuk = $izinMasuk->groupBy('surat_izin_masuk.id')
                           ->orderBy('surat_izin_masuk.created_at', 'DESC')
                           ->findAll();

    // Pelanggaran detail
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
        ->join('surat_izin_masuk', 'surat_izin_masuk.id = surat_izin_pelanggaran.surat_masuk_id', 'left');

    if ($startDate) {
        $pelanggaran->where('surat_izin_pelanggaran.created_at >=', $startDate);
    }
    if ($endDate) {
        $pelanggaran->where('surat_izin_pelanggaran.created_at <=', $endDate);
    }

    $pelanggaran = $pelanggaran->orderBy('surat_izin_pelanggaran.created_at', 'DESC')
                               ->findAll();

    $data = [
        'izinKeluar'   => $izinKeluar,
        'izinMasuk'    => $izinMasuk,
        'pelanggaran'  => $pelanggaran,
    ];

    return view('pages/admin/laporan', $data);
}

}