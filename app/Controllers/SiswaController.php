<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\ActivityLogModel;

class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $activityLogModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->activityLogModel = new ActivityLogModel();
    }

    public function dataSiswa()
    {
        $filters = [
            'keyword'  => $this->request->getGet('keyword') ?? '',
            'kelas'    => $this->request->getGet('kelas') ?? '',
            'jk'       => $this->request->getGet('jk') ?? '',
            'tahun'    => $this->request->getGet('tahun') ?? '',
            'poin'     => $this->request->getGet('poin') ?? '',
            'no_absen' => $this->request->getGet('no_absen') ?? ''
        ];

        $builder = $this->siswaModel;

        // Filter pencarian
        if ($filters['keyword']) {
            $builder->groupStart()
                ->like('nama', $filters['keyword'])
                ->orLike('nis', $filters['keyword'])
                ->orLike('nism', $filters['keyword'])
                ->groupEnd();
        }

        // Filter kelas
        if ($filters['kelas']) {
            $builder->like('kelas', $filters['kelas']);
        }

        // Filter jurusan
        if ($filters['jurusan']) {
            $builder->where('jurusan', $filters['jurusan']);
        }

        // Filter jenis kelamin
        if ($filters['jk']) {
            $builder->where('jk', $filters['jk']);
        }

        // Filter tahun ajaran
        if ($filters['tahun']) {
            $builder->where('tahun_ajaran', $filters['tahun']);
        }

        // Filter poin
        if ($filters['poin']) {
            if ($filters['poin'] === '0-50') {
                $builder->where('poin >=', 0)->where('poin <=', 50);
            } elseif ($filters['poin'] === '51-100') {
                $builder->where('poin >=', 51)->where('poin <=', 100);
            } elseif ($filters['poin'] === '>100') {
                $builder->where('poin >', 100);
            }
        }

        // Filter nomor absen
        if ($filters['no_absen']) {
            $builder->where('no_absen', $filters['no_absen']);
        }

        // Ambil data siswa
        $siswa = $builder->findAll(); // Batasi ke 100 hasil untuk performa

        // Log aktivitas pencarian/filter
        if (array_filter($filters)) {
            $filterDesc = array_filter($filters, fn($value) => !empty($value));
            $desc = 'Pencarian siswa dengan filter: ' . json_encode($filterDesc);
            $this->activityLogModel->save([
                'type' => 'siswa',
                'description' => $desc,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('user_id') ?? 0
            ]);
        }

        return view('pages/piket/data_siswa', [
            'title'   => 'Data Siswa',
            'siswa'   => $siswa,
            'filters' => $filters
        ]);
    }

public function siswa()
{
    $filters = [
        'search'   => $this->request->getGet('search') ?? '',
        'kelas'    => $this->request->getGet('kelas') ?? '',
        'jurusan'  => $this->request->getGet('jurusan') ?? '',
        'tahun'    => $this->request->getGet('tahun') ?? '',
        'jk'       => $this->request->getGet('jk') ?? '',
        'poin'     => $this->request->getGet('poin') ?? '',
        'no_absen' => $this->request->getGet('no_absen') ?? ''
    ];

    $perPage = 20; // Jumlah siswa per halaman
    $page = max(1, (int) $this->request->getGet('page') ?? 1); // Pastikan page minimal 1

    // Query untuk menghitung total records dengan filter
    $totalQuery = clone $this->siswaModel;
    $this->applyFilters($totalQuery, $filters);
    $totalRecords = $totalQuery->countAllResults();

    // Query untuk data siswa dengan limit dan offset
    $builder = $this->siswaModel;
    $this->applyFilters($builder, $filters);
    $offset = max(0, ($page - 1) * $perPage); // Pastikan offset tidak negatif
    $siswa = $builder->findAll($perPage, $offset);

    // Hitung total halaman
    $totalPages = ceil($totalRecords / $perPage);

    // Log aktivitas pencarian/filter
    if (array_filter($filters)) {
        $filterDesc = array_filter($filters, fn($value) => !empty($value));
        $desc = 'Pencarian siswa dengan filter: ' . json_encode($filterDesc) . ' (Halaman: ' . $page . ')';
        $this->activityLogModel->save([
            'type' => 'siswa',
            'description' => $desc,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id') ?? 0
        ]);
    }

    return view('pages/admin/siswa', [
        'title' => 'Data Siswa',
        'siswa' => $siswa,
        'filters' => $filters,
        'currentPage' => $page,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'totalPages' => $totalPages
    ]);
}

// Helper method untuk menerapkan filter
private function applyFilters($builder, $filters)
{
    // Filter pencarian
    if ($filters['search']) {
        $builder->groupStart()
            ->like('nama', $filters['search'])
            ->orLike('nis', $filters['search'])
            ->orLike('nism', $filters['search'])
            ->groupEnd();
    }

    // Filter kelas
    if ($filters['kelas']) {
        $builder->like('kelas', $filters['kelas']);
    }

    // Filter jurusan
    if ($filters['jurusan']) {
        $builder->where('jurusan', $filters['jurusan']);
    }

    // Filter tahun ajaran
    if ($filters['tahun']) {
        $builder->where('tahun_ajaran', $filters['tahun']);
    }

    // Filter jenis kelamin
    if ($filters['jk']) {
        $builder->where('jk', $filters['jk']);
    }

    // Filter poin
    if ($filters['poin']) {
        if ($filters['poin'] === '0-50') {
            $builder->groupStart()
                ->where('poin >=', 0)
                ->where('poin <=', 50)
                ->groupEnd();
        } elseif ($filters['poin'] === '51-100') {
            $builder->groupStart()
                ->where('poin >=', 51)
                ->where('poin <=', 100)
                ->groupEnd();
        } elseif ($filters['poin'] === '>100') {
            $builder->where('poin >', 100);
        }
    }

    // Filter nomor absen
    if ($filters['no_absen']) {
        $builder->where('no_absen', $filters['no_absen']);
    }
}

    public function detailSiswa($id)
    {
        $siswa = $this->siswaModel->find($id);

        if (!$siswa) {
            return redirect()->to('/admin/siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'siswa',
            'description' => 'Melihat detail siswa: ' . esc($siswa['nama']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id') ?? 0
        ]);

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

        $validationRules = [
            'nis' => 'required|numeric',
            'nism' => 'permit_empty',
            'nama' => 'required',
            'jk' => 'required|in_list[L,P]',
            'kelas' => 'required',
            'tahun_ajaran' => 'permit_empty',
            'poin' => 'permit_empty|numeric',
            'no_absen' => 'permit_empty|numeric'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal: ' . implode(', ', $this->validator->getErrors()));
        }

        $this->siswaModel->update($id, $data);

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'siswa',
            'description' => 'Data siswa diperbarui: ' . esc($data['nama']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id') ?? 0
        ]);

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
                        $this->activityLogModel->save([
                            'type' => 'siswa',
                            'description' => 'Kelas siswa diperbarui: ' . esc($siswa['nama']) . ' ke kelas 11',
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => session()->get('user_id') ?? 0
                        ]);
                    } elseif ($tingkatKelas === 11) {
                        $this->siswaModel->update($siswa['id'], ['kelas' => '12' . $nomorKelas]);
                        $this->activityLogModel->save([
                            'type' => 'siswa',
                            'description' => 'Kelas siswa diperbarui: ' . esc($siswa['nama']) . ' ke kelas 12',
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => session()->get('user_id') ?? 0
                        ]);
                    } elseif ($tingkatKelas === 12) {
                        $this->siswaModel->update($siswa['id'], ['kelas' => null]);
                        $this->activityLogModel->save([
                            'type' => 'siswa',
                            'description' => 'Kelas siswa dihapus (lulus): ' . esc($siswa['nama']),
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => session()->get('user_id') ?? 0
                        ]);
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

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'siswa',
            'description' => 'Siswa dihapus: ' . esc($siswa['nama']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id') ?? 0
        ]);

        return redirect()->to('/admin/siswa')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function hapus_lulus()
    {
        try {
            $siswaList = $this->siswaModel->where('kelas LIKE "12%"')->findAll();
            $this->siswaModel->where('kelas LIKE "12%"')->delete();

            foreach ($siswaList as $siswa) {
                $this->activityLogModel->save([
                    'type' => 'siswa',
                    'description' => 'Siswa kelas 12 dihapus: ' . esc($siswa['nama']),
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session()->get('user_id') ?? 0
                ]);
            }

            return redirect()->to('/admin/siswa')->with('success', 'Data siswa kelas 12 berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/siswa')->with('error', 'Gagal menghapus siswa kelas 12: ' . $e->getMessage());
        }
    }

    public function tambah()
    {
        $data = $this->request->getPost();

        $validationRules = [
            'nis' => 'required|numeric|is_unique[siswa.nis]',
            'nism' => 'permit_empty',
            'nama' => 'required',
            'jk' => 'required|in_list[L,P]',
            'kelas' => 'required',
            'tahun_ajaran' => 'permit_empty',
            'poin' => 'permit_empty|numeric',
            'no_absen' => 'permit_empty|numeric'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal: ' . implode(', ', $this->validator->getErrors()));
        }

        $this->siswaModel->save($data);

        // Log aktivitas
        $this->activityLogModel->save([
            'type' => 'siswa',
            'description' => 'Siswa baru ditambahkan: ' . esc($data['nama']),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('user_id') ?? 0
        ]);

        return redirect()->to('/admin/siswa')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function import_csv()
    {
        $file = $this->request->getFile('csv_file');

        if (!$file->isValid() || !in_array($file->getExtension(), ['csv', 'xls', 'xlsx'])) {
            return redirect()->to('/admin/siswa')->with('error', 'File tidak valid. Harap unggah file CSV atau Excel.');
        }

        $csv = array_map('str_getcsv', file($file->getTempName()));
        $header = array_shift($csv);

        $requiredFields = ['nis', 'nama', 'jk', 'kelas'];
        if (count(array_intersect($requiredFields, $header)) !== count($requiredFields)) {
            return redirect()->to('/admin/siswa')->with('error', 'Format CSV tidak valid. Harus mengandung kolom: ' . implode(', ', $requiredFields));
        }

        try {
            foreach ($csv as $row) {
                $data = array_combine($header, $row);
                $this->siswaModel->save($data);

                // Log aktivitas
                $this->activityLogModel->save([
                    'type' => 'siswa',
                    'description' => 'Siswa baru diimpor: ' . esc($data['nama']),
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session()->get('user_id') ?? 0
                ]);
            }
            return redirect()->to('/admin/siswa')->with('success', 'Data siswa dari CSV berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->to('/admin/siswa')->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}