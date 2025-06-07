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

$routes->group('dashboard', function ($routes) {
    $routes->get('piket', 'Dashboard::piket'); 
    $routes->get('bp', 'Dashboard::bp');       
    $routes->get('admin', 'Dashboard::admin'); 
});

$routes->group('piket', function ($routes) {
    $routes->get('surat_izin', 'Piket::formIzin');        
    $routes->post('surat_izin', 'Piket::simpanIzin');     
    $routes->get('izin_cetak/(:num)', 'Piket::cetakIzin/$1');
    $routes->get('konfirmasi_kembali', 'Piket::konfirmasiKembali'); 
    $routes->post('catat-pelanggaran', 'Piket::catatPelanggaran');  
    $routes->get('data_siswa', 'Piket::dataSiswa'); 

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
