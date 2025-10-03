<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\SuratIzinModel;
use App\Models\SuratIzinMasukModel;
use App\Models\SuratIzinPelanggaranModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanAdminController extends BaseController
{
    public function index()
    {
        $izinKeluarModel   = new SuratIzinModel();
        $izinMasukModel    = new SuratIzinMasukModel();
        $pelanggaranModel  = new SuratIzinPelanggaranModel();

        // ambil parameter
        $startDate = $this->request->getGet('start_date');
        $endDate   = $this->request->getGet('end_date');
        $jenis     = $this->request->getGet('jenis') ?? 'all';
        $searchNama = trim($this->request->getGet('search_nama') ?? '');
        $export    = $this->request->getGet('export');

        if ($endDate) {
            // supaya jam terakhir tetap ikut
            $endDate = date('Y-m-d 23:59:59', strtotime($endDate));
        }
        if ($startDate) {
            $startDate = date('Y-m-d 00:00:00', strtotime($startDate));
        }

        // Query Izin Keluar
        $izinKeluarBuilder = $izinKeluarModel
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
            $izinKeluarBuilder->where('surat_izin.created_at >=', $startDate);
        }
        if ($endDate) {
            $izinKeluarBuilder->where('surat_izin.created_at <=', $endDate);
        }
        if ($searchNama) {
            $izinKeluarBuilder->like('surat_izin.nama', $searchNama);
        }

        if ($jenis == 'all' || $jenis == 'keluar') {
            $izinKeluar = $izinKeluarBuilder->groupBy('surat_izin.id')
                                            ->orderBy('surat_izin.created_at', 'DESC')
                                            ->findAll();
        } else {
            $izinKeluar = [];
        }

        // Query Izin Masuk
        $izinMasukBuilder = $izinMasukModel
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
            $izinMasukBuilder->where('surat_izin_masuk.created_at >=', $startDate);
        }
        if ($endDate) {
            $izinMasukBuilder->where('surat_izin_masuk.created_at <=', $endDate);
        }
        if ($searchNama) {
            $izinMasukBuilder->like('surat_izin_masuk.nama', $searchNama);
        }

        if ($jenis == 'all' || $jenis == 'masuk') {
            $izinMasuk = $izinMasukBuilder->groupBy('surat_izin_masuk.id')
                                          ->orderBy('surat_izin_masuk.created_at', 'DESC')
                                          ->findAll();
        } else {
            $izinMasuk = [];
        }

        // Pelanggaran detail (tidak diubah untuk sekarang, bisa diintegrasikan jika perlu)
        $pelanggaranBuilder = $pelanggaranModel
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
            $pelanggaranBuilder->where('surat_izin_pelanggaran.created_at >=', $startDate);
        }
        if ($endDate) {
            $pelanggaranBuilder->where('surat_izin_pelanggaran.created_at <=', $endDate);
        }

        $pelanggaran = $pelanggaranBuilder->orderBy('surat_izin_pelanggaran.created_at', 'DESC')
                                          ->findAll();

        $data = [
            'izinKeluar'   => $izinKeluar,
            'izinMasuk'    => $izinMasuk,
            'pelanggaran'  => $pelanggaran,
            'jenis'        => $jenis,
            'title'   => 'Rekap Surat Izin',
        ];

        if ($export) {
            return $this->exportExcel($izinKeluar, $izinMasuk, $startDate, $endDate, $jenis, $searchNama);
        }

        return view('pages/admin/laporan', $data);
    }

    private function exportExcel($izinKeluar, $izinMasuk, $startDate, $endDate, $jenis, $searchNama)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle('Laporan Rekap Surat Izin');

        $sheetKeluar = null;
        $sheetMasuk = null;

        // Sheet untuk Izin Keluar
        if (empty($jenis) || $jenis == 'all' || $jenis == 'keluar') {
            $sheetKeluar = $spreadsheet->createSheet();
            $sheetKeluar->setTitle('Izin Keluar');
            $sheetKeluar->setCellValue('A1', 'No');
            $sheetKeluar->setCellValue('B1', 'Nama');
            $sheetKeluar->setCellValue('C1', 'NISN');
            $sheetKeluar->setCellValue('D1', 'Kelas');
            $sheetKeluar->setCellValue('E1', 'Tanggal');
            $sheetKeluar->setCellValue('F1', 'Waktu Keluar');
            $sheetKeluar->setCellValue('G1', 'Waktu Kembali');
            $sheetKeluar->setCellValue('H1', 'Alasan');
            $sheetKeluar->setCellValue('I1', 'Pelanggaran');
            $sheetKeluar->setCellValue('J1', 'Total Poin');

            $row = 2;
            $no = 1;
            foreach ($izinKeluar as $izin) {
                $sheetKeluar->setCellValue('A' . $row, $no++);
                $sheetKeluar->setCellValue('B' . $row, $izin['nama']);
                $sheetKeluar->setCellValue('C' . $row, $izin['nisn']);
                $sheetKeluar->setCellValue('D' . $row, $izin['kelas']);
                $sheetKeluar->setCellValue('E' . $row, date('d-m-Y', strtotime($izin['created_at'])));
                $sheetKeluar->setCellValue('F' . $row, $izin['waktu_keluar']);
                $sheetKeluar->setCellValue('G' . $row, $izin['waktu_kembali']);
                $sheetKeluar->setCellValue('H' . $row, $izin['alasan']);
                $sheetKeluar->setCellValue('I' . $row, $izin['pelanggaran_list'] ?: '-');
                $sheetKeluar->setCellValue('J' . $row, $izin['total_poin'] ?: 0);
                $row++;
            }
        }

        // Sheet untuk Izin Masuk
        if (empty($jenis) || $jenis == 'all' || $jenis == 'masuk') {
            $sheetMasuk = $spreadsheet->createSheet();
            $sheetMasuk->setTitle('Izin Masuk');
            $sheetMasuk->setCellValue('A1', 'No');
            $sheetMasuk->setCellValue('B1', 'Nama');
            $sheetMasuk->setCellValue('C1', 'NISN');
            $sheetMasuk->setCellValue('D1', 'Kelas');
            $sheetMasuk->setCellValue('E1', 'Tanggal');
            $sheetMasuk->setCellValue('F1', 'Alasan Terlambat');
            $sheetMasuk->setCellValue('G1', 'Tindak Lanjut');
            $sheetMasuk->setCellValue('H1', 'Pelanggaran');
            $sheetMasuk->setCellValue('I1', 'Total Poin');

            $row = 2;
            $no = 1;
            foreach ($izinMasuk as $izin) {
                $sheetMasuk->setCellValue('A' . $row, $no++);
                $sheetMasuk->setCellValue('B' . $row, $izin['nama']);
                $sheetMasuk->setCellValue('C' . $row, $izin['nisn']);
                $sheetMasuk->setCellValue('D' . $row, $izin['kelas']);
                $sheetMasuk->setCellValue('E' . $row, date('d-m-Y', strtotime($izin['created_at'])));
                $sheetMasuk->setCellValue('F' . $row, $izin['alasan_terlambat']);
                $sheetMasuk->setCellValue('G' . $row, $izin['tindak_lanjut']);
                $sheetMasuk->setCellValue('H' . $row, $izin['pelanggaran_list'] ?: '-');
                $sheetMasuk->setCellValue('I' . $row, $izin['total_poin'] ?: 0);
                $row++;
            }
        }

        // Hapus sheet default jika ada sheet yang dibuat
        if (isset($sheetKeluar) || isset($sheetMasuk)) {
            $spreadsheet->removeSheetByIndex(0);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Rekap_Surat_Izin_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}