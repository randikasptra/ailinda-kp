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
        $filters = [
            'search'  => $this->request->getGet('keyword') ?? '',
            'kelas'   => $this->request->getGet('kelas') ?? '',
            'jurusan' => $this->request->getGet('jurusan') ?? '',
            'jk'      => $this->request->getGet('jk') ?? ''
        ];

        $builder = $this->siswaModel;

        if ($filters['search']) {
            $builder->groupStart()
                ->like('nama', $filters['search'])
                ->orLike('nis', $filters['search'])
                ->groupEnd();
        }

        if ($filters['kelas']) {
            $builder->like('kelas', $filters['kelas']);
        }

        if ($filters['jurusan']) {
            $builder->where('jurusan', $filters['jurusan']);
        }

        if ($filters['jk']) {
            $builder->where('jk', $filters['jk']);
        }

        // ✅ Ambil semua data siswa tanpa limit
        $siswa = $builder->findAll();

        return view('pages/piket/data_siswa', [
            'title'   => 'Data Siswa',
            'siswa'   => $siswa,
            'filters' => $filters
        ]);
    }


    public function siswa()
    {
        $filters = [
            'search'  => $this->request->getGet('search') ?? '',
            'kelas'   => $this->request->getGet('kelas') ?? '',
            'jurusan' => $this->request->getGet('jurusan') ?? '',
            'tahun'   => $this->request->getGet('tahun') ?? '',
            'jk'      => $this->request->getGet('jk') ?? ''
        ];

        $builder = $this->siswaModel;

        if ($filters['search']) {
            $builder->groupStart()
                ->like('nama', $filters['search'])
                ->orLike('nis', $filters['search'])
                ->groupEnd();
        }

        if ($filters['kelas']) {
            $builder->like('kelas', $filters['kelas']);
        }

        if ($filters['jurusan']) {
            $builder->where('jurusan', $filters['jurusan']);
        }

        if ($filters['tahun']) {
            $builder->where('tahun_ajaran', $filters['tahun']);
        }

        if ($filters['jk']) {
            $builder->where('jk', $filters['jk']);
        }

        // ✅ Ambil semua data tanpa batas
        $siswa = $builder->findAll();

        return view('pages/admin/siswa', [
            'siswa'   => $siswa,
            'filters' => $filters
        ]);
    }


    public function detailSiswa($id)
    {
        $siswa = $this->siswaModel->find($id);

        if (!$siswa) {
            return redirect()->to('/admin/siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('pages/admin/detail_siswa', [
            'title' => 'Detail Siswa',
            'siswa' => $siswa
        ]);
    }

    public function editSiswa($id)
    {
        $siswa = $this->siswaModel->find($id);

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
        $siswa = $this->siswaModel->find($id);

        if (!$siswa) {
            return redirect()->to('/admin/siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        $data = $this->request->getPost();

        // Validasi input
        $validationRules = [
            'nis' => 'required|numeric',
            'nama' => 'required',
            'jk' => 'required|in_list[L,P]',
            'kelas' => 'required',
            'jurusan' => 'required|in_list[SAINTEK,SOSHUM,BAHASA]',
            'poin' => 'permit_empty|numeric'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal: ' . implode(', ', $this->validator->getErrors()));
        }

        $this->siswaModel->update($id, $data);
        return redirect()->to('/admin/siswa')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function update_kelas()
    {
        $siswaList = $this->siswaModel->findAll();

        if (empty($siswaList)) {
            return redirect()->to('/admin/siswa')->with('error', 'Tidak ada data siswa yang ditemukan.');
        }

        try {
            foreach ($siswaList as $siswa) {
                if (!empty($siswa['kelas'])) {
                    $kelasParts = explode('.', $siswa['kelas']);
                    $tingkatKelas = (int) $kelasParts[0];
                    $nomorKelas = isset($kelasParts[1]) ? '.' . $kelasParts[1] : '';

                    if ($tingkatKelas === 10) {
                        $this->siswaModel->update($siswa['id'], ['kelas' => '11' . $nomorKelas]);
                    } elseif ($tingkatKelas === 11) {
                        $this->siswaModel->update($siswa['id'], ['kelas' => '12' . $nomorKelas]);
                    } elseif ($tingkatKelas === 12) {
                        $this->siswaModel->update($siswa['id'], ['kelas' => null]);
                    }
                }
            }

            return redirect()->to('/admin/siswa')->with('success', 'Kelas siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/siswa')->with('error', 'Gagal memperbarui kelas siswa: ' . $e->getMessage());
        }
    }

    public function hapus($id)
    {
        $siswa = $this->siswaModel->find($id);

        if (!$siswa) {
            return redirect()->to('/admin/siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        $this->siswaModel->delete($id);
        return redirect()->to('/admin/siswa')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function hapus_lulus()
    {
        try {
            $this->siswaModel->where('kelas LIKE "12%"')->delete();
            return redirect()->to('/admin/siswa')->with('success', 'Data siswa kelas 12 berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/siswa')->with('error', 'Gagal menghapus siswa kelas 12: ' . $e->getMessage());
        }
    }

    public function tambah()
    {
        $data = $this->request->getPost();

        // Validasi input
        $validationRules = [
            'nis' => 'required|numeric|is_unique[siswa.nis]',
            'nama' => 'required',
            'jk' => 'required|in_list[L,P]',
            'kelas' => 'required',
            'jurusan' => 'required|in_list[SAINTEK,SOSHUM,BAHASA]',
            'poin' => 'permit_empty|numeric'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal: ' . implode(', ', $this->validator->getErrors()));
        }

        $this->siswaModel->save($data);
        return redirect()->to('/admin/siswa')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function import_csv()
    {
        $file = $this->request->getFile('csv_file');

        if (!$file->isValid() || !in_array($file->getExtension(), ['csv', 'xls', 'xlsx'])) {
            return redirect()->to('/admin/siswa')->with('error', 'File tidak valid. Harap unggah file CSV atau Excel.');
        }

        $csv = array_map('str_getcsv', file($file->getTempName()));
        $header = array_shift($csv); // Ambil header

        $requiredFields = ['nis', 'nama', 'jk', 'kelas', 'jurusan'];
        if (count(array_intersect($requiredFields, $header)) !== count($requiredFields)) {
            return redirect()->to('/admin/siswa')->with('error', 'Format CSV tidak valid. Harus mengandung kolom: ' . implode(', ', $requiredFields));
        }

        try {
            foreach ($csv as $row) {
                $data = array_combine($header, $row);
                $this->siswaModel->save($data);
            }
            return redirect()->to('/admin/siswa')->with('success', 'Data siswa dari CSV berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/siswa')->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}