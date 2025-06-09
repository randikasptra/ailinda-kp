<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth
// Redirect root

$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');


// Redirect default dashboard ke admin
$routes->get('dashboard', 'Dashboard::admin', ['filter' => 'role:admin']);

// Dashboard masing-masing role
$routes->group('dashboard', function ($routes) {
    $routes->get('piket', 'Dashboard::piket', ['filter' => 'role:piket']);
    $routes->get('bp', 'Dashboard::bp', ['filter' => 'role:bp']);
    $routes->get('admin', 'Dashboard::admin', ['filter' => 'role:admin']);
});

// Halaman untuk piket
$routes->group('piket', ['filter' => 'role:piket'], function ($routes) {
    $routes->get('surat_izin', 'Piket::formIzin');
    $routes->post('surat_izin', 'Piket::simpanIzin');
    $routes->get('izin_cetak/(:num)', 'Piket::cetakIzin/$1');
    $routes->get('konfirmasi_kembali', 'Piket::konfirmasiKembali');
    $routes->post('catat-pelanggaran', 'Piket::catatPelanggaran');
    $routes->get('data_siswa', 'Piket::dataSiswa');
    $routes->get('history_konfirmasi', 'Piket::history');
});

// Halaman untuk BP
$routes->group('bp', ['filter' => 'role:bp'], function ($routes) {
    $routes->get('rekap', 'BP::rekapPelanggaran');
    $routes->get('detail-siswa/(:num)', 'BP::detailSiswa/$1');
});

// Halaman Admin
$routes->group('admin', ['filter' => 'authAdmin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('users', 'Admin::listUsers');
    $routes->get('users/create', 'Admin::createUser');
    $routes->post('users/store', 'Admin::storeUser');
    $routes->get('users/edit/(:num)', 'Admin::editUser/$1');
    $routes->post('users/update/(:num)', 'Admin::updateUser/$1');
    $routes->get('users/delete/(:num)', 'Admin::deleteUser/$1');
});

// Optional: pelanggaran bebas akses
$routes->get('/pelanggaran', 'Pelanggaran::index');
$routes->get('unauthorized', 'Error::unauthorized');

