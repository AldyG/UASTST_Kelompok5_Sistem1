<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index'); // Halaman login
$routes->get('/login', 'AuthController::index'); // Halaman login
$routes->post('/login', 'AuthController::login'); // Proses login
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'DashboardController::index'); // Dashboard setelah login
$routes->get('nilai/input/(:segment)', 'NilaiController::input/$1');
$routes->post('/nilai/simpan/(:segment)', 'NilaiController::simpan/$1'); // Menyimpan nilai
$routes->get('nilai/lihat/(:any)', 'NilaiController::lihatNilai/$1');// Melihat nilai
$routes->post('nilai/simpanNilai', 'NilaiController::simpanNilai');
$routes->post('nilai/finalisasiNilai/(:any)', 'NilaiController::finalisasiNilai/$1');
$routes->get('/api/penilaian-dosen', 'PenilaianDosenController::index');