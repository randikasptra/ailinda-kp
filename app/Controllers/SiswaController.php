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
}