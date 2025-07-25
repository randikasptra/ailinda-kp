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
$routes->get('dashboard', 'Dashboard::admin', ['filter' => 'role:admin']);

$routes->group('dashboard', function ($routes) {
    $routes->get('piket', 'Dashboard::piket', ['filter' => 'role:piket']);
    $routes->get('bp', 'Dashboard::bp', ['filter' => 'role:bp']);
    $routes->get('admin', 'Dashboard::admin', ['filter' => 'role:admin']);
});

// =======================
// PIKET
// =======================
$routes->group('piket', ['filter' => 'role:piket'], function ($routes) {
    $routes->get('surat_izin', 'Piket::formIzin');
    $routes->post('surat_izin', 'Piket::simpanIzin');
    $routes->get('izin_cetak/(:num)', 'Piket::cetakIzin/$1');
    $routes->get('konfirmasi_kembali', 'Piket::konfirmasiKembali');

    $routes->get('izin_masuk_form', 'Piket::izinMasukForm');
    $routes->get('izin_masuk_form(:num)', 'Piket::cetakIzinMasuk/$1');
    $routes->post('izin_masuk/submit', 'Piket::submitIzinMasuk');

    $routes->post('catat-pelanggaran', 'Piket::catatPelanggaran');
    $routes->get('data_siswa', 'Piket::dataSiswa');
    $routes->get('history_konfirmasi', 'HistoryKonfirmasi::history');
    $routes->get('history_konfirmasi/delete/(:num)', 'HistoryKonfirmasi::delete/$1');
    $routes->post('history_konfirmasi/hapus_hari_ini', 'HistoryKonfirmasi::hapusHariIni');
    $routes->get('history_konfirmasi/edit/(:num)', 'HistoryKonfirmasi::edit/$1'); // untuk fetch data modal
    $routes->post('history_konfirmasi/update/(:num)', 'HistoryKonfirmasi::update/$1'); 
});


// =======================
// BP
// =======================
$routes->group('bp', ['filter' => 'role:bp'], function ($routes) {

    $routes->get('hapus-poin/(:num)', 'Bp::hapusPoin/$1'); // ini penting!
    $routes->get('rekap_poin', 'Bp::rekapPoin');
    $routes->post('hapus-poin', 'Bp::hapusPoin');

});
// =======================
// ADMIN
// =======================
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('siswa/detail_siswa/(:num)', 'Dashboard::detailSiswa/$1');
    $routes->get('siswa', 'Dashboard::siswa');
    $routes->post('siswa/tambah', 'Dashboard::tambahSiswa');
    $routes->get('siswa/hapus/(:num)', 'Dashboard::hapusSiswa/$1');
    $routes->get('pelanggaran/edit/(:num)', 'Dashboard::editPelanggaran/$1');
    $routes->post('pelanggaran/update/(:num)', 'Dashboard::updatePelanggaran/$1');
    $routes->post('siswa/update_kelas', 'Dashboard::update_kelas');
    $routes->post('siswa/hapus_lulus', 'Dashboard::hapus_lulus');


    // User Management
    $routes->get('users', 'Dashboard::users');
    $routes->get('users/tambah', 'Dashboard::tambahUser');
    $routes->post('tambahUser', 'Dashboard::tambahUser');
    $routes->post('users/store', 'Admin::storeUser');
    $routes->get('users/edit/(:num)', 'Admin::editUser/$1');
    $routes->post('users/update/(:num)', 'Admin::updateUser/$1');
    $routes->get('pelanggaran', 'Dashboard::pelanggaran');
    $routes->post('pelanggaran/tambah', 'Dashboard::tambahPelanggaran');
    $routes->get('pelanggaran/hapus/(:num)', 'Dashboard::hapusPelanggaran/$1');
    $routes->get('editUser/(:num)', 'Dashboard::editUser/$1');
    $routes->post('updateUser/(:num)', 'Dashboard::updateUser/$1');
    $routes->post('deleteUser/(:num)', 'Dashboard::deleteUser/$1');
    $routes->get('users/delete/(:num)', 'Dashboard::deleteUser/$1');
    $routes->get('siswa/edit_siswa/(:num)', 'Dashboard::editSiswa/$1');
    $routes->post('siswa/update/(:num)', 'Dashboard::updateSiswa/$1');


    $routes->post('siswa/import_csv', 'Dashboard::importCSV');


});

// =======================
// LAIN-LAIN
// =======================
$routes->get('pelanggaran', 'Pelanggaran::index');
$routes->get('unauthorized', 'Error::unauthorized');

$routes->group('dashboard', function ($routes) {
    $routes->get('rekap_poin', 'Bp::rekapPoin');
});