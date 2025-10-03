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
    public function keluar()
    {
        $izinKeluarModel = new SuratIzinModel();
        $pelanggaranModel = new SuratIzinPelanggaranModel();

        // Ambil parameter
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $searchNama = trim($this->request->getGet('search_nama') ?? '');
        $export = $this->request->getGet('export');

        // Set default dates if not provided (mirip script di view)
        if (!$startDate) {
            $today = date('Y-m-d');
            $firstDay = date('Y-m-01', strtotime($today));
            $startDate = date('Y-m-d 00:00:00', strtotime($firstDay));
        } else {
            $startDate = date('Y-m-d 00:00:00', strtotime($startDate));
        }

        if (!$endDate) {
            $today = date('Y-m-d');
            $endDate = date('Y-m-d 23:59:59', strtotime($today));
        } else {
            $endDate = date('Y-m-d 23:59:59', strtotime($endDate));
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

        $izinKeluarBuilder->where('surat_izin.created_at >=', $startDate);
        $izinKeluarBuilder->where('surat_izin.created_at <=', $endDate);
        
        if ($searchNama) {
            $izinKeluarBuilder->like('surat_izin.nama', $searchNama);
        }

        $izinKeluar = $izinKeluarBuilder->groupBy('surat_izin.id')
                                        ->orderBy('surat_izin.created_at', 'DESC')
                                        ->findAll();

        // Pelanggaran detail (khusus untuk keluar)
        $pelanggaranBuilder = $pelanggaranModel
            ->select("
                surat_izin_pelanggaran.*,
                pelanggaran.jenis_pelanggaran,
                pelanggaran.kategori,
                pelanggaran.poin,
                surat_izin.nama as nama_siswa_keluar
            ")
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->join('surat_izin', 'surat_izin.id = surat_izin_pelanggaran.surat_izin_id', 'left')
            ->where('surat_izin_pelanggaran.surat_masuk_id IS NULL'); // Hanya pelanggaran keluar

        $pelanggaranBuilder->where('surat_izin_pelanggaran.created_at >=', $startDate);
        $pelanggaranBuilder->where('surat_izin_pelanggaran.created_at <=', $endDate);

        $pelanggaran = $pelanggaranBuilder->orderBy('surat_izin_pelanggaran.created_at', 'DESC')
                                          ->findAll();

        $data = [
            'izinKeluar' => $izinKeluar,
            'pelanggaran' => $pelanggaran,
            'title' => 'Rekap Surat Izin Keluar',
        ];

        if ($export) {
            return $this->exportExcelKeluar($izinKeluar, $startDate, $endDate, $searchNama);
        }

        return view('pages/admin/laporan_keluar', $data);
    }

    public function masuk()
    {
        $izinMasukModel = new SuratIzinMasukModel();
        $pelanggaranModel = new SuratIzinPelanggaranModel();

        // Ambil parameter
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $searchNama = trim($this->request->getGet('search_nama') ?? '');
        $export = $this->request->getGet('export');

        // Set default dates if not provided (mirip script di view)
        if (!$startDate) {
            $today = date('Y-m-d');
            $firstDay = date('Y-m-01', strtotime($today));
            $startDate = date('Y-m-d 00:00:00', strtotime($firstDay));
        } else {
            $startDate = date('Y-m-d 00:00:00', strtotime($startDate));
        }

        if (!$endDate) {
            $today = date('Y-m-d');
            $endDate = date('Y-m-d 23:59:59', strtotime($today));
        } else {
            $endDate = date('Y-m-d 23:59:59', strtotime($endDate));
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

        $izinMasukBuilder->where('surat_izin_masuk.created_at >=', $startDate);
        $izinMasukBuilder->where('surat_izin_masuk.created_at <=', $endDate);
        
        if ($searchNama) {
            $izinMasukBuilder->like('surat_izin_masuk.nama', $searchNama);
        }

        $izinMasuk = $izinMasukBuilder->groupBy('surat_izin_masuk.id')
                                      ->orderBy('surat_izin_masuk.created_at', 'DESC')
                                      ->findAll();

        // Pelanggaran detail (khusus untuk masuk)
        $pelanggaranBuilder = $pelanggaranModel
            ->select("
                surat_izin_pelanggaran.*,
                pelanggaran.jenis_pelanggaran,
                pelanggaran.kategori,
                pelanggaran.poin,
                surat_izin_masuk.nama as nama_siswa_masuk
            ")
            ->join('pelanggaran', 'pelanggaran.id = surat_izin_pelanggaran.pelanggaran_id', 'left')
            ->join('surat_izin_masuk', 'surat_izin_masuk.id = surat_izin_pelanggaran.surat_masuk_id', 'left')
            ->where('surat_izin_pelanggaran.surat_izin_id IS NULL'); // Hanya pelanggaran masuk

        $pelanggaranBuilder->where('surat_izin_pelanggaran.created_at >=', $startDate);
        $pelanggaranBuilder->where('surat_izin_pelanggaran.created_at <=', $endDate);

        $pelanggaran = $pelanggaranBuilder->orderBy('surat_izin_pelanggaran.created_at', 'DESC')
                                          ->findAll();

        $data = [
            'izinMasuk' => $izinMasuk,
            'pelanggaran' => $pelanggaran,
            'title' => 'Rekap Surat Izin Masuk',
        ];

        if ($export) {
            return $this->exportExcelMasuk($izinMasuk, $startDate, $endDate, $searchNama);
        }

        return view('pages/admin/laporan_masuk', $data);
    }

    // Method lama index() bisa dihapus atau dialihkan ke redirect ke salah satu page, misal keluar
    public function index()
    {
        return redirect()->to('/admin/laporan/keluar');
    }

    private function exportExcelKeluar($izinKeluar, $startDate, $endDate, $searchNama)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle('Laporan Rekap Surat Izin Keluar');

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

        // Hapus sheet default jika ada sheet yang dibuat
        $spreadsheet->removeSheetByIndex(0);

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Rekap_Surat_Izin_Keluar_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    private function exportExcelMasuk($izinMasuk, $startDate, $endDate, $searchNama)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle('Laporan Rekap Surat Izin Masuk');

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

        // Hapus sheet default jika ada sheet yang dibuat
        $spreadsheet->removeSheetByIndex(0);

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Rekap_Surat_Izin_Masuk_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}