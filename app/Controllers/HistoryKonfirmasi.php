<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistoryKonfirmasiModel;
use App\Models\HistoryKonfirmasiPelanggaranModel;
use App\Models\SiswaModel;
use App\Models\PelanggaranModel;
use App\Models\SuratIzinMasukModel; // Tambahkan model untuk surat masuk

class HistoryKonfirmasi extends BaseController
{
    protected $historyModel;
    protected $relasiModel;
    protected $siswaModel;
    protected $pelanggaranModel;
    protected $suratMasukModel; // Model untuk surat masuk

    public function __construct()
    {
        $this->historyModel = new HistoryKonfirmasiModel();
        $this->relasiModel = new HistoryKonfirmasiPelanggaranModel();
        $this->siswaModel = new SiswaModel();
        $this->pelanggaranModel = new PelanggaranModel();
        $this->suratMasukModel = new SuratIzinMasukModel(); // Inisialisasi model surat masuk
    }

    // 🔹 List History dengan JOIN pelanggaran dan data surat masuk
    public function history()
    {
        $keyword = $this->request->getGet('keyword') ?? '';

        $db = \Config\Database::connect();

        // Query untuk history konfirmasi (surat keluar)
        $builder = $db->table('history_konfirmasi hk')
            ->select('
                hk.id,
                hk.izin_id,
                s.nis as nisn, 
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
            ->join('siswa s', 'hk.nama = s.nama AND hk.kelas = s.kelas', 'left')
            ->join('history_konfirmasi_pelanggaran hkp', 'hk.id = hkp.history_konfirmasi_id', 'left')
            ->join('pelanggaran p', 'hkp.pelanggaran_id = p.id', 'left')
            ->groupBy('hk.id');

        // Filter pencarian untuk history konfirmasi
        if ($keyword) {
            $builder->groupStart()
                ->like('hk.nama', $keyword)
                ->orLike('s.nis', $keyword)
                ->orLike('hk.kelas', $keyword)
                ->groupEnd();
        }

        $builder->orderBy('hk.updated_at', 'DESC');

        $data = [
            'title' => 'Riwayat Konfirmasi Kembali',
            'historyList' => $builder->get()->getResultArray(),
        ];

        // Query untuk surat masuk
        $suratMasukBuilder = $this->suratMasukModel;

        if ($keyword) {
            $suratMasukBuilder->groupStart()
                ->like('nama', $keyword)
                ->orLike('nisn', $keyword)
                ->orLike('kelas', $keyword)
                ->groupEnd();
        }

        $data['suratMasukList'] = $suratMasukBuilder->orderBy('created_at', 'DESC')->findAll();

        return view('pages/piket/history_konfirmasi', $data);
    }

    // 🔹 Hapus satu history (beserta relasi pelanggarannya)
    public function delete($id)
    {
        // Cek apakah history ada
        if (!$this->historyModel->find($id)) {
            return redirect()->back()->with('error', 'Data konfirmasi tidak ditemukan.');
        }

        try {
            $this->relasiModel->where('history_konfirmasi_id', $id)->delete();
            $this->historyModel->delete($id);
            return redirect()->back()->with('success', 'Data konfirmasi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data konfirmasi: ' . $e->getMessage());
        }
    }

    // 🔹 Hapus history hari ini
    public function hapusHariIni()
    {
        $today = date('Y-m-d');
        $histories = $this->historyModel->where('DATE(created_at)', $today)->findAll();

        if (empty($histories)) {
            return redirect()->back()->with('error', 'Tidak ada data konfirmasi untuk hari ini.');
        }

        try {
            foreach ($histories as $h) {
                $this->relasiModel->where('history_konfirmasi_id', $h['id'])->delete();
                $this->historyModel->delete($h['id']);
            }
            return redirect()->back()->with('success', 'Semua data konfirmasi hari ini telah dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data konfirmasi: ' . $e->getMessage());
        }
    }

    // 🔹 Hapus satu surat masuk
    public function deleteSuratMasuk($id)
    {
        if (!$this->suratMasukModel->find($id)) {
            return redirect()->back()->with('error', 'Data surat masuk tidak ditemukan.');
        }

        try {
            $this->suratMasukModel->delete($id);
            return redirect()->back()->with('success', 'Data surat masuk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data surat masuk: ' . $e->getMessage());
        }
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
        // Validasi input
        if (!$this->validate([
            'nama' => 'required|min_length[3]|max_length[100]',
            'kelas' => 'required|regex_match[/^\d{1,2}\.\d{2}$/]', 
            'waktu_kembali_siswa' => 'permit_empty|valid_date[Y-m-d H:i:s]',
            'pelanggaran_ids' => 'permit_empty|is_natural_no_zero',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Cek apakah history ada
        if (!$this->historyModel->find($id)) {
            return redirect()->back()->with('error', 'Data konfirmasi tidak ditemukan.');
        }

        // Ambil data dari form
        $data = $this->request->getPost();

        // Siapkan data untuk update
        $updateData = [
            'nama' => $data['nama'] ?? null,
            'kelas' => $data['kelas'] ?? null,
            'waktu_kembali_siswa' => $data['waktu_kembali_siswa'] ?? null,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        try {
            // Update data history
            $this->historyModel->update($id, $updateData);

            // Update relasi pelanggaran jika ada
            if (isset($data['pelanggaran_ids']) && is_array($data['pelanggaran_ids'])) {
                $this->relasiModel->where('history_konfirmasi_id', $id)->delete();
                foreach ($data['pelanggaran_ids'] as $pid) {
                    $this->relasiModel->insert([
                        'history_konfirmasi_id' => $id,
                        'pelanggaran_id' => $pid,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
}