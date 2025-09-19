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
}