<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index'); // Halaman login
$routes->post('/login', 'AuthController::login'); // Proses login
$routes->get('/dashboard', 'NilaiController::dashboard'); // Dashboard setelah login
$routes->get('/nilai/input', 'NilaiController::input'); // Halaman input nilai
$routes->post('/nilai/simpan', 'NilaiController::simpan'); // Menyimpan nilai
$routes->get('/nilai/lihat', 'NilaiController::lihat'); // Melihat nilai
