<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelanggaranModel;
use App\Models\ActivityLogModel;

class PelanggaranController extends BaseController
{
    protected $pelanggaranModel;
    protected $activityLogModel;

    public function __construct()
    {
        $this->pelanggaranModel = new PelanggaranModel();
        $this->activityLogModel = new ActivityLogModel();
    }

    public function pelanggaran()
    {
        $filters = [
            'kategori' => $this->request->getGet('kategori') ?? '',
            'poin'     => $this->request->getGet('poin') ?? '',
            'search'   => $this->request->getGet('search') ?? '',
        ];

        $builder = $this->pelanggaranModel;

        if ($filters['kategori']) {
            $builder->where('kategori', $filters['kategori']);
        }

        if ($filters['poin']) {
            if ($filters['poin'] === '0-10') {
                $builder->where('poin >=', 0)->where('poin <=', 10);
            } elseif ($filters['poin'] === '11-20') {
                $builder->where('poin >=', 11)->where('poin <=', 20);
            } elseif ($filters['poin'] === '>20') {
                $builder->where('poin >', 20);
            }
        }

        if ($filters['search']) {
            $builder->like('jenis_pelanggaran', $filters['search']);
        }

        $data = [
            'title'       => 'Kelola Pelanggaran',
            'pelanggaran' => $builder->findAll(),
            'filters'     => $filters
        ];

        return view('pages/admin/pelanggaran', $data);
    }

    public function tambahPelanggaran()
    {
        $data = $this->request->getPost();

        if ($data) {
            $this->pelanggaranModel->save($data);

            // Log aktivitas
            $this->activityLogModel->save([
                'type' => 'pelanggaran',
                'description' => 'Pelanggaran baru ditambahkan: ' . esc($data['jenis_pelanggaran']),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('user_id')
            ]);

            return redirect()->to('/admin/pelanggaran')->with('success', 'Pelanggaran berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan pelanggaran.');
    }
    public function tambahPelanggaranPiket()
    {
        $data = $this->request->getPost();

        if ($data) {
            $this->pelanggaranModel->save($data);

            // Log aktivitas
            $this->activityLogModel->save([
                'type' => 'pelanggaran',
                'description' => 'Pelanggaran baru ditambahkan: ' . esc($data['jenis_pelanggaran']),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('user_id')
            ]);

            return redirect()->to('piket/surat_izin_rekapan')->with('success', 'Pelanggaran berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan pelanggaran.');
    }

    public function hapusPelanggaran($id)
    {
        $pelanggaran = $this->pelanggaranModel->find($id);
        $this->pelanggaranModel->delete($id);

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'pelanggaran',
            'description' => 'Pelanggaran dihapus: ' . esc($pelanggaran['jenis_pelanggaran']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id')
        ]);

        return redirect()->to('/admin/pelanggaran')->with('success', 'Pelanggaran berhasil dihapus!');
    }

    public function editPelanggaran($id)
    {
        $data['title'] = 'Edit Pelanggaran';
        $data['pelanggaran'] = $this->pelanggaranModel->find($id);

        if (!$data['pelanggaran']) {
            return redirect()->to('/admin/pelanggaran')->with('error', 'Data tidak ditemukan.');
        }

        return view('pages/admin/edit_pelanggaran', $data);
    }

    public function updatePelanggaran($id)
    {
        $data = $this->request->getPost();

        $this->pelanggaranModel->update($id, [
            'jenis_pelanggaran' => $data['jenis_pelanggaran'],
            'kategori'          => $data['kategori'] ?? null,
            'poin'              => $data['poin']
        ]);

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'pelanggaran',
            'description' => 'Pelanggaran diperbarui: ' . esc($data['jenis_pelanggaran']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id')
        ]);

        return redirect()->to('/admin/pelanggaran')->with('success', 'Data pelanggaran berhasil diperbarui.');
    }
}