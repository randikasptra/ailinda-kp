<?php

namespace App\Controllers;

use App\Models\SiswaModel;

class SiswaController extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function dataSiswa()
    {
        $keyword = $this->request->getGet('keyword');
        $kelas = $this->request->getGet('kelas');
        $jurusan = $this->request->getGet('jurusan');
        $jk = $this->request->getGet('jk');

        $builder = $this->siswaModel;

        if ($keyword) {
            $builder = $builder->groupStart()
                ->like('nama', $keyword)
                ->orLike('nis', $keyword)
                ->orLike('nism', $keyword)
                ->groupEnd();
        }

        if ($kelas) {
            $builder = $builder->like('kelas', $kelas);
        }

        if ($jurusan) {
            $builder = $builder->where('jurusan', $jurusan);
        }

        if ($jk) {
            $builder = $builder->where('jk', $jk);
        }

        $siswa = $builder->findAll();

        return view('pages/piket/data_siswa', [
            'title' => 'Data Siswa',
            'siswa' => $siswa,
            'filter' => [
                'keyword' => $keyword,
                'kelas' => $kelas,
                'jurusan' => $jurusan,
                'jk' => $jk
            ]
        ]);
    }

    public function siswa()
    {
        $search = $this->request->getGet('search');
        $kelas = $this->request->getGet('kelas');
        $jurusan = $this->request->getGet('jurusan');
        $tahun = $this->request->getGet('tahun');
        $jk = $this->request->getGet('jk');

        $builder = $this->siswaModel->builder();

        if (!empty($search)) {
            $builder->groupStart()
                ->like('nama', $search)
                ->orLike('nis', $search)
                ->orLike('nism', $search)
                ->groupEnd();
        }
        if (!empty($kelas)) {
            $builder->like('kelas', $kelas);
        }
        if (!empty($jurusan)) {
            $builder->where('jurusan', $jurusan);
        }
        if (!empty($tahun)) {
            $builder->where('tahun_ajaran', $tahun);
        }
        if (!empty($jk)) {
            $builder->where('jk', $jk);
        }

        $data['siswa'] = $builder->get()->getResultArray();

        // Lempar nilai filter ke view
        $data['filters'] = [
            'search'  => $search,
            'kelas'   => $kelas,
            'jurusan' => $jurusan,
            'tahun'   => $tahun,
            'jk'      => $jk,
        ];

        return view('pages/admin/siswa', $data);
    }
     public function detailSiswa($id)
    {
        $model = new \App\Models\SiswaModel();
        $data['siswa'] = $model->find($id);
        return view('pages/admin/detail_siswa', $data);
    }
    public function editSiswa($id)
    {
        $model = new SiswaModel();
        $siswa = $model->find($id);

        if (!$siswa) {
            return redirect()->to('/admin/siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('pages/admin/edit_siswa', [
            'title' => 'Edit Data Siswa',
            'siswa' => $siswa
        ]);
    }
    public function updateSiswa($id)
    {
        $model = new SiswaModel();
        $data = $this->request->getPost();

        $model->update($id, $data);
        return redirect()->to('/admin/siswa')->with('success', 'Data siswa berhasil diperbarui!');
    }
    
    public function update_kelas()
    {
        $model = new \App\Models\SiswaModel();

        // Ambil semua siswa
        $siswaList = $model->findAll();

        if (empty($siswaList)) {
            return redirect()->back()->with('error', 'Tidak ada data siswa yang ditemukan.');
        }

        try {
            foreach ($siswaList as $siswa) {
                // Pastikan kelas tidak null
                if (!empty($siswa['kelas'])) {
                    // Pisahkan tingkat kelas dan nomor kelas (contoh: 10.02 -> [10, 02])
                    $kelasParts = explode('.', $siswa['kelas']);
                    $tingkatKelas = (int) $kelasParts[0]; // Ambil bagian tingkat (10, 11, 12)
                    $nomorKelas = isset($kelasParts[1]) ? '.' . $kelasParts[1] : ''; // Ambil bagian nomor (.02, .01, dll.)

                    // Naik kelas jika 10 atau 11, null-kan jika 12
                    if ($tingkatKelas === 10) {
                        $model->update($siswa['id'], ['kelas' => '11' . $nomorKelas]);
                    } elseif ($tingkatKelas === 11) {
                        $model->update($siswa['id'], ['kelas' => '12' . $nomorKelas]);
                    } elseif ($tingkatKelas === 12) {
                        $model->update($siswa['id'], ['kelas' => null]);
                    }
                }
            }

            return redirect()->back()->with('success', 'Kelas siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui kelas siswa: ' . $e->getMessage());
        }
    }
}