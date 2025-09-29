<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================
// AUTH
// =======================
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');

// =======================
// DASHBOARD
// =======================
$routes->group('dashboard', function ($routes) {
    $routes->get('admin', 'Dashboard::admin', ['filter' => 'role:admin']);
    $routes->get('piket', 'Dashboard::piket', ['filter' => 'role:piket']);
    $routes->get('bp', 'Dashboard::bp', ['filter' => 'role:bp']);
    $routes->get('rekap_poin', 'Bp::rekapPoin', ['filter' => 'role:bp']);
});

// =======================
// PIKET
// =======================
$routes->group('piket', ['filter' => 'role:piket'], function ($routes) {
    // Surat Izin Keluar
    $routes->get('surat_izin', 'Piket::formIzin');
    $routes->post('surat_izin', 'Piket::simpanIzin');
    $routes->get('izin_cetak/(:num)', 'Piket::cetakIzin/$1');
    $routes->get('konfirmasi_kembali', 'Piket::konfirmasiKembali');

    // Surat Izin Masuk
    $routes->get('izin_masuk_form', 'Piket::izinMasukForm');
    $routes->post('izin_masuk/submit', 'Piket::submitIzinMasuk');
    $routes->get('surat_izin_masuk', 'SuratIzinMasukController::index');
    $routes->post('surat_izin_masuk/simpan', 'SuratIzinMasukController::simpan');
    $routes->get('surat_izin_masuk/edit/(:num)', 'SuratIzinMasukController::edit/$1');
    $routes->get('surat_izin_masuk/delete/(:num)', 'SuratIzinMasukController::delete/$1');

    // Pelanggaran (oleh Piket)
    $routes->get('pelanggaran', 'PelanggaranController::pelanggaranPiket');
    $routes->post('pelanggaran/tambah', 'PelanggaranController::tambahPelanggaranPiket');
    $routes->get('pelanggaran/edit/(:num)', 'PelanggaranController::editPelanggaranPiket/$1');
    $routes->post('pelanggaran/update/(:num)', 'PelanggaranController::updatePelanggaranPiket/$1');
    $routes->get('pelanggaran/hapus/(:num)', 'PelanggaranController::hapusPelanggaranPiket/$1');

    // Surat Izin Rekapan
    $routes->get('surat_izin_rekapan', 'SuratIzinRekapanController::index');
    $routes->post('surat_izin_pelanggaran/(:num)', 'SuratIzinRekapanController::savePelanggaran/$1');

    // Data Siswa
    $routes->get('data_siswa', 'SiswaController::dataSiswa');
    $routes->get('data_siswa/laporan', 'LaporanIzinController::index');

    // History Konfirmasi
    $routes->get('history_konfirmasi', 'HistoryKonfirmasi::history');
    $routes->get('history_konfirmasi/edit/(:num)', 'HistoryKonfirmasi::edit/$1');
    $routes->post('history_konfirmasi/update/(:num)', 'HistoryKonfirmasi::update/$1');
    $routes->get('history_konfirmasi/delete/(:num)', 'HistoryKonfirmasi::delete/$1');
    $routes->post('history_konfirmasi/hapus_hari_ini', 'HistoryKonfirmasi::hapusHariIni');
});

// =======================
// BP
// =======================
$routes->group('bp', ['filter' => 'role:bp'], function ($routes) {
    $routes->get('rekap_poin', 'Bp::rekapPoin');
    $routes->get('hapus-poin/(:num)', 'Bp::hapusPoin/$1');
    $routes->post('hapus-poin', 'Bp::hapusPoin');
});

// =======================
// ADMIN
// =======================
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');

    // Siswa
    $routes->get('siswa', 'SiswaController::siswa');
    $routes->get('siswa/detail/(:num)', 'SiswaController::detailSiswa/$1');
    $routes->get('siswa/edit/(:num)', 'SiswaController::editSiswa/$1');
    $routes->post('siswa/update/(:num)', 'SiswaController::updateSiswa/$1');
    $routes->post('siswa/tambah', 'Dashboard::tambahSiswa');
    $routes->get('siswa/hapus/(:num)', 'Dashboard::hapusSiswa/$1');
    $routes->post('siswa/update_kelas', 'SiswaController::update_kelas');
    $routes->post('siswa/hapus_lulus', 'Dashboard::hapus_lulus');
    $routes->post('siswa/import_csv', 'Dashboard::importCSV');

    // Pelanggaran
    $routes->get('pelanggaran', 'PelanggaranController::pelanggaran');
    $routes->post('pelanggaran/tambah', 'PelanggaranController::tambahPelanggaran');
    $routes->get('pelanggaran/edit/(:num)', 'PelanggaranController::editPelanggaran/$1');
    $routes->post('pelanggaran/update/(:num)', 'PelanggaranController::updatePelanggaran/$1');
    $routes->get('pelanggaran/hapus/(:num)', 'PelanggaranController::hapusPelanggaran/$1');

    // User Management
    $routes->get('users', 'Dashboard::users');
    $routes->get('users/tambah', 'Dashboard::tambahUser');
    $routes->post('users/store', 'Admin::storeUser');
    $routes->get('users/edit/(:num)', 'Admin::editUser/$1');
    $routes->post('users/update/(:num)', 'Admin::updateUser/$1');
    $routes->get('users/delete/(:num)', 'Dashboard::deleteUser/$1');
});

// =======================
// SURAT IZIN
// =======================
$routes->get('suratizin', 'SuratIzinController::index');
$routes->get('suratizin/search', 'SuratIzinController::search');
$routes->post('suratizin/simpan', 'SuratIzinController::simpan');
$routes->post('suratizin/store', 'SuratIzinController::store');

// =======================
// ERROR
// =======================
$routes->get('unauthorized', 'Error::unauthorized');
