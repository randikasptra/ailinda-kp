<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SanksiSiswaModel;
use App\Models\SiswaModel;
use App\Models\PelanggaranModel;

class SanksiAdminController extends BaseController
{
    protected $sanksiModel;
    protected $siswaModel;
    protected $pelanggaranModel;

    public function __construct()
    {
        $this->sanksiModel      = new SanksiSiswaModel();
        $this->siswaModel       = new SiswaModel();
        $this->pelanggaranModel = new PelanggaranModel();
    }

    public function index()
    {
        $keyword   = $this->request->getGet('keyword');
        $startDate = $this->request->getGet('start_date') ?: date('Y-m-d', strtotime('-30 days'));
        $endDate   = $this->request->getGet('end_date') ?: date('Y-m-d');

        $builder = $this->sanksiModel
            ->select('sanksi_siswa.*, sanksi_siswa.id as sanksi_id, siswa.id as siswa_id, siswa.nama, siswa.nis, siswa.kelas, pelanggaran.jenis_pelanggaran, pelanggaran.kategori, pelanggaran.poin')
            ->join('siswa', 'siswa.id = sanksi_siswa.siswa_id')
            ->join('pelanggaran', 'pelanggaran.id = sanksi_siswa.pelanggaran_id')
            ->where('sanksi_siswa.tanggal_pelanggaran >=', $startDate)
            ->where('sanksi_siswa.tanggal_pelanggaran <=', $endDate);

        if ($keyword) {
            $builder->groupStart()
                ->like('siswa.nama', $keyword)
                ->orLike('siswa.nis', $keyword)
                ->orLike('pelanggaran.jenis_pelanggaran', $keyword)
            ->groupEnd();
        }

        $rawData = $builder
            ->orderBy('sanksi_siswa.tanggal_pelanggaran', 'DESC')
            ->findAll();

        // Grouping
        $groupedData = [];
        foreach ($rawData as $row) {
            $key = $row['siswa_id'] . '-' . $row['tanggal_pelanggaran'];

            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [
                    'siswa_id'            => $row['siswa_id'],
                    'nama'                => $row['nama'],
                    'nis'                 => $row['nis'],
                    'kelas'               => $row['kelas'],
                    'tanggal_pelanggaran' => $row['tanggal_pelanggaran'],
                    'jenis_pelanggaran'   => [],
                    'kategori'            => [],
                    'poin'                => 0,
                    'keterangan'          => [],
                    'sanksi_ids'          => [],
                ];
            }

            $groupedData[$key]['jenis_pelanggaran'][] = $row['jenis_pelanggaran'];
            $groupedData[$key]['kategori'][]          = $row['kategori'];
            $groupedData[$key]['poin']               += (int)$row['poin'];
            if (!empty($row['keterangan'])) {
                $groupedData[$key]['keterangan'][] = $row['keterangan'];
            }
            $groupedData[$key]['sanksi_ids'][] = $row['sanksi_id'];
        }

        foreach ($groupedData as &$data) {
            $data['jenis_pelanggaran'] = implode(', ', $data['jenis_pelanggaran']);
            $data['kategori']          = implode(', ', array_unique($data['kategori']));
            $data['keterangan']        = !empty($data['keterangan']) ? implode(', ', $data['keterangan']) : 'Tidak ada';
            $data['pelanggaran_list']  = array_values(array_filter($rawData, function($r) use ($data) {
                return $r['nama'] == $data['nama'] && $r['tanggal_pelanggaran'] == $data['tanggal_pelanggaran'];
            }));
        }

        $sanksiData  = array_values($groupedData);
        $pelanggaran = $this->pelanggaranModel->findAll();

        return view('pages/admin/sanksi_siswa', [
            'sanksiData'  => $sanksiData,
            'keyword'     => $keyword,
            'startDate'   => $startDate,
            'endDate'     => $endDate,
            'pelanggaran' => $pelanggaran, // ✅ ini dikirim ke view
            'title' => 'Laporan Sanksi Siswa',

        ]);
    }



    /**
     * Delete grouped sanksi records.
     * Dapat menerima POST with ids[] (multiple id), atau endpoint single id jika ingin.
     */
    public function delete($id)
    {
        // Cari data sanksi berdasarkan id
        $sanksi = $this->sanksiModel->find($id);

        if (!$sanksi) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $siswaId = $sanksi['siswa_id'];
        $tanggal = $sanksi['tanggal_pelanggaran'];

        // Ambil semua pelanggaran siswa di tanggal yang sama
        $pelanggaranHariItu = $this->sanksiModel
            ->where('siswa_id', $siswaId)
            ->where('tanggal_pelanggaran', $tanggal)
            ->findAll();

        if (empty($pelanggaranHariItu)) {
            return redirect()->back()->with('error', 'Tidak ada pelanggaran ditemukan pada tanggal tersebut.');
        }

        // Hitung total poin yang akan dikurangi
        $totalPoin = array_sum(array_column($pelanggaranHariItu, 'poin_didapat'));

        // Update poin siswa
        $siswa = $this->siswaModel->find($siswaId);
        if ($siswa) {
            $poinBaru = max(0, ((int)$siswa['poin']) - $totalPoin);
            $this->siswaModel->update($siswaId, ['poin' => $poinBaru]);
        }

        // Hapus semua pelanggaran di tanggal itu untuk siswa tersebut
        $this->sanksiModel
            ->where('siswa_id', $siswaId)
            ->where('tanggal_pelanggaran', $tanggal)
            ->delete();

        return redirect()->back()->with(
            'success',
            "Semua pelanggaran pada tanggal {$tanggal} berhasil dihapus dan poin siswa diperbarui."
        );
    }

   public function exportExcel()
{
    $keyword   = $this->request->getGet('keyword');
    $startDate = $this->request->getGet('start_date') ?: date('Y-m-d', strtotime('-30 days'));
    $endDate   = $this->request->getGet('end_date') ?: date('Y-m-d');

    $builder = $this->sanksiModel
        ->select('sanksi_siswa.*, sanksi_siswa.id as sanksi_id, siswa.id as siswa_id, siswa.nama, siswa.nis, siswa.kelas, pelanggaran.jenis_pelanggaran, pelanggaran.kategori, pelanggaran.poin')
        ->join('siswa', 'siswa.id = sanksi_siswa.siswa_id')
        ->join('pelanggaran', 'pelanggaran.id = sanksi_siswa.pelanggaran_id')
        ->where('sanksi_siswa.tanggal_pelanggaran >=', $startDate)
        ->where('sanksi_siswa.tanggal_pelanggaran <=', $endDate);

    if ($keyword) {
        $builder->groupStart()
            ->like('siswa.nama', $keyword)
            ->orLike('siswa.nis', $keyword)
            ->orLike('pelanggaran.jenis_pelanggaran', $keyword)
        ->groupEnd();
    }

    $rawData = $builder
        ->orderBy('sanksi_siswa.tanggal_pelanggaran', 'DESC')
        ->findAll();

    // Group data (berdasarkan siswa + tanggal)
    $groupedData = [];
    foreach ($rawData as $row) {
        // kalau mau group per hari saja (jam diabaikan):
        $key = $row['siswa_id'] . '-' . date('Y-m-d', strtotime($row['tanggal_pelanggaran']));
        // kalau mau per entri (jam juga beda) pakai ini:
        // $key = $row['siswa_id'] . '-' . $row['tanggal_pelanggaran'];

        if (!isset($groupedData[$key])) {
    $groupedData[$key] = [
        'Nama' => $row['nama'],
        'NIS' => $row['nis'],
        'Kelas' => $row['kelas'],
        'Tanggal Pelanggaran' => date('d/m/Y H:i:s', strtotime($row['tanggal_pelanggaran'])),
        'Jenis Pelanggaran' => [],
        'Kategori' => [],
        'Total Poin' => 0,
        'Keterangan' => $row['keterangan'] ?? 'Tidak ada',
        'Updated At' => $row['updated_at'], // ✅ tambahin ini
    ];
}


        $groupedData[$key]['Jenis Pelanggaran'][] = $row['jenis_pelanggaran'];
        $groupedData[$key]['Kategori'][] = $row['kategori'];
        $groupedData[$key]['Total Poin'] += (int)$row['poin'];
    }

    // Format final
    $exportData = [];
    foreach ($groupedData as $data) {
        $exportData[] = [
    'Nama' => $data['Nama'],
    'NIS' => $data['NIS'],
    'Kelas' => $data['Kelas'],
    'Tanggal Pelanggaran' => ($data['Updated At']) 
        ? date('d/m/Y H:i:s', strtotime($data['Updated At'])) 
        : '-', // ✅ tampilkan update_at
    'Jenis Pelanggaran' => implode(', ', $data['Jenis Pelanggaran']),
    'Kategori' => implode(', ', array_unique($data['Kategori'])),
    'Total Poin' => $data['Total Poin'],
    'Keterangan' => $data['Keterangan'],
    // 'Diupdate Terakhir' => !empty($data['Updated At']) 
    //     ? date('d/m/Y H:i:s', strtotime($data['Updated At'])) 
    //     : '-', // ✅ tampilkan update_at
];

    }

    // 🧾 Buat file Excel
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $headers = array_keys($exportData[0] ?? []);
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '1', $header);
        $sheet->getStyle($col . '1')->getFont()->setBold(true);
        $sheet->getColumnDimension($col)->setAutoSize(true);
        $col++;
    }

    // Data
    $rowIndex = 2;
    foreach ($exportData as $row) {
        $col = 'A';
        foreach ($row as $value) {
            $sheet->setCellValue($col . $rowIndex, $value);
            $col++;
        }
        $rowIndex++;
    }

    // Download
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'Data_Sanksi_Siswa_' . date('Ymd_His') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit();
}



public function updatePelanggaran()
{
    $siswaId     = $this->request->getPost('siswa_id');
    $tanggal     = $this->request->getPost('tanggal_pelanggaran');
    $hapusIds    = $this->request->getPost('hapus_ids') ?? [];
    $pelanggaranIds = $this->request->getPost('pelanggaran_ids') ?? [];
    $keterangan  = $this->request->getPost('keterangan');

    // 🔹 Hapus pelanggaran yang dipilih
    if (!empty($hapusIds)) {
        foreach ($hapusIds as $id) {
            $this->sanksiModel->delete($id);
        }
    }

    // 🔹 Tambahkan pelanggaran baru
    if (!empty($pelanggaranIds)) {
        foreach ($pelanggaranIds as $pId) {
            $this->sanksiModel->insert([
                'siswa_id'            => $siswaId,
                'pelanggaran_id'      => $pId,
                'tanggal_pelanggaran' => $tanggal,
                'keterangan'          => $keterangan,
            ]);
        }
    }

    // 🔹 Update keterangan di semua pelanggaran aktif hari itu (optional)
    if (!empty($keterangan)) {
        $this->sanksiModel
            ->where('siswa_id', $siswaId)
            ->where('tanggal_pelanggaran', $tanggal)
            ->set(['keterangan' => $keterangan])
            ->update();
    }

    return redirect()->back()->with('success', 'Data pelanggaran berhasil diperbarui.');
}

 


}
