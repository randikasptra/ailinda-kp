<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth
$routes->get('/', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

// Dashboard

// Tambahin ini biar akses /dashboard langsung ke admin
$routes->get('dashboard', 'Dashboard::admin');

// Group dashboard tetap bisa dipakai juga
$routes->group('dashboard', function ($routes) {
    $routes->get('piket', 'Dashboard::piket'); // views/pages/piket/piket.php ✅
    $routes->get('bp', 'Dashboard::bp');       // views/pages/bp/bp.php ✅
    $routes->get('admin', 'Dashboard::admin');       // views/pages/bp/bp.php ✅
});

// Surat Izin (Piket)
$routes->group('piket', function ($routes) {
    $routes->get('surat_izin', 'Piket::formIzin');        // views/pages/piket/surat_izin.php ❗️pastikan nama file benar
    $routes->post('surat_izin', 'Piket::simpanIzin');
    $routes->get('konfirmasi-kembali', 'Piket::konfirmasiKembali'); // views/pages/piket/konfirmasi_kembali.php ❗️

    $routes->get('piket/surat_izin/cetak/(:num)', 'Piket\SuratIzin::cetak/$1');
    $routes->post('catat-pelanggaran', 'Piket::catatPelanggaran');   // views/pages/piket/catat_pelanggaran.php ❗️
});

// Pelanggaran (BP)
$routes->group('bp', function ($routes) {
    $routes->get('rekap', 'BP::rekapPelanggaran');         // views/pages/bp/rekap.php ✅
    $routes->get('detail-siswa/(:num)', 'BP::detailSiswa/$1');
});


$routes->group('admin', ['filter' => 'authAdmin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('users', 'Admin::listUsers');
    $routes->get('users/create', 'Admin::createUser');
    $routes->post('users/store', 'Admin::storeUser');
    $routes->get('users/edit/(:num)', 'Admin::editUser/$1');
    $routes->post('users/update/(:num)', 'Admin::updateUser/$1');
    $routes->get('users/delete/(:num)', 'Admin::deleteUser/$1');
});
