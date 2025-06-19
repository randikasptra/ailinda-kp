<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistoryKonfirmasiModel;
use App\Models\SiswaModel;

class HistoryKonfirmasi extends BaseController
{
    protected $historyModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->historyModel = new HistoryKonfirmasiModel();
        $this->siswaModel = new SiswaModel();
    }

   public function history()
{
    $data = [
        'title' => 'Riwayat Konfirmasi Kembali',
        'historyList' => $this->historyModel
            ->orderBy('updated_at', 'DESC')
            ->findAll(),
    ];

    return view('pages/piket/history_konfirmasi', $data);
}

   

    public function delete($id)
    {
        $this->historyModel->delete($id);
        return redirect()->back()->with('success', 'Data konfirmasi berhasil dihapus.');
    }


    
    public function hapusHariIni()
    {
        $today = date('Y-m-d');
        $this->historyModel->where('DATE(created_at)', $today)->delete();
        return redirect()->back()->with('success', 'Semua data konfirmasi hari ini telah dihapus.');
    }

    public function edit($id)
    {
        $data = $this->historyModel->find($id);
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        $this->historyModel->update($id, [
            'nama' => $data['nama'],
            'kelas' => $data['kelas'],
            'waktu_kembali_siswa' => $data['waktu_kembali_siswa'],
            'poin_pelanggaran' => $data['poin_pelanggaran'],
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    
}