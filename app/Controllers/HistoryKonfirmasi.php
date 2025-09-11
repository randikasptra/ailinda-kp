<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistoryKonfirmasiModel;
use App\Models\HistoryKonfirmasiPelanggaranModel;
use App\Models\SiswaModel;
use App\Models\PelanggaranModel;

class HistoryKonfirmasi extends BaseController
{
    protected $historyModel;
    protected $relasiModel;
    protected $siswaModel;
    protected $pelanggaranModel;

    public function __construct()
    {
        $this->historyModel = new HistoryKonfirmasiModel();
        $this->relasiModel = new HistoryKonfirmasiPelanggaranModel();
        $this->siswaModel = new SiswaModel();
        $this->pelanggaranModel = new PelanggaranModel();
    }

    // 🔹 List History dengan JOIN pelanggaran
   public function history()
{
    $db = \Config\Database::connect();

    $builder = $db->table('history_konfirmasi hk')
        ->select('
            hk.id,
            hk.izin_id,
            hk.nama,
            hk.kelas,
            hk.waktu_keluar,
            hk.waktu_kembali,
            hk.waktu_kembali_siswa,
            hk.created_at,
            hk.updated_at,
            GROUP_CONCAT(p.jenis_pelanggaran SEPARATOR ", ") as pelanggaran,
            COALESCE(SUM(p.poin), 0) as total_poin
        ')
        ->join('history_konfirmasi_pelanggaran hkp', 'hk.id = hkp.history_konfirmasi_id', 'left')
        ->join('pelanggaran p', 'hkp.pelanggaran_id = p.id', 'left')
        ->groupBy('hk.id')
        ->orderBy('hk.updated_at', 'DESC');

    $data = [
        'title' => 'Riwayat Konfirmasi Kembali',
        'historyList' => $builder->get()->getResultArray(),
    ];

    // Coba debug dulu untuk lihat hasil
    // dd($data['historyList']);

    return view('pages/piket/history_konfirmasi', $data);
}


    // 🔹 Hapus satu history (beserta relasi pelanggarannya)
    public function delete($id)
    {
        $this->relasiModel->where('history_konfirmasi_id', $id)->delete();
        $this->historyModel->delete($id);

        return redirect()->back()->with('success', 'Data konfirmasi berhasil dihapus.');
    }

    // 🔹 Hapus history hari ini
    public function hapusHariIni()
    {
        $today = date('Y-m-d');
        $histories = $this->historyModel->where('DATE(created_at)', $today)->findAll();

        foreach ($histories as $h) {
            $this->relasiModel->where('history_konfirmasi_id', $h['id'])->delete();
            $this->historyModel->delete($h['id']);
        }

        return redirect()->back()->with('success', 'Semua data konfirmasi hari ini telah dihapus.');
    }

    // 🔹 Ambil data untuk edit (return JSON)
    public function edit($id)
    {
        $history = $this->historyModel->find($id);

        if (!$history) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Data tidak ditemukan']);
        }

        return $this->response->setJSON($history);
    }

    // 🔹 Update data history
    public function update($id)
    {
        $data = $this->request->getPost();

        $updateData = [
            'nama' => $data['nama'] ?? null,
            'kelas' => $data['kelas'] ?? null,
            'waktu_kembali_siswa' => $data['waktu_kembali_siswa'] ?? null,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->historyModel->update($id, $updateData);

        // 🚨 Kalau nanti ada form pelanggaran di modal, tinggal aktifin block ini:
        /*
        $this->relasiModel->where('history_konfirmasi_id', $id)->delete();
        if (!empty($data['pelanggaran_ids'])) {
            foreach ($data['pelanggaran_ids'] as $pid) {
                $this->relasiModel->insert([
                    'history_konfirmasi_id' => $id,
                    'pelanggaran_id' => $pid,
                ]);
            }
        }
        */

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
