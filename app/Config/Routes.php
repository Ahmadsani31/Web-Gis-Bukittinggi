<?php

use App\Controllers\Administrator\Layer;
use App\Controllers\Administrator\Berita;
use App\Controllers\Administrator\Dashboard;
use App\Controllers\Dashboard as Home;
use App\Controllers\Administrator\Datatable;
use App\Controllers\Datatable as DHome;
use App\Controllers\Administrator\Distrik;
use App\Controllers\Administrator\Drainase;
use App\Controllers\Administrator\GenanganAir;
use App\Controllers\Administrator\Modal;
use App\Controllers\Administrator\Pengaduan;
use App\Controllers\Administrator\User;
use App\Controllers\Delete;
use App\Controllers\Peta;
use App\Controllers\SelectDuo;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/signin', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// $routes->get('/', 'Home::index');
$routes->get('/', [Home::class, 'index']);
$routes->get('/peta', [Peta::class, 'index']);
$routes->post('/peta/get-coordinat', [Peta::class, 'getCoordinatByID']);
$routes->post('/peta/load-sidebar', [Peta::class, 'loadSidebar']);
$routes->post('/peta/detail-coordinat', [Peta::class, 'getCordinat']);
$routes->post('/peta/load-all-layer', [Peta::class, 'loadAllLayer']);


// $routes->post('/all-cordinat', 'Dashboard::getAllCordinat');
// $routes->post('/load/data-layers', 'Dashboard::loadDatalayer');
// $routes->post('/cordinat', 'Dashboard::getCordinat');
$routes->get('/data-gis-extrak', 'Home::gis_extrak');
// $routes->get('/data-gis-data', 'Home::gis_data');
// $routes->post('/get-coordinat', 'Home::getCoordinat');
$routes->get('/peta/detail-drainase/(:segment)', [Peta::class, 'detailDreainase/$1']);
$routes->get('/peta/detail-genangan-air/(:segment)', [Peta::class, 'detailAir/$1']);
$routes->post('/peta/data-grafik', [Peta::class, 'dataGrafik']);
$routes->get('/peta/legend', [Peta::class, 'loadLegend']);

$routes->get('/data-pengaduan', [Pengaduan::class, 'show']);

// $routes->post('/load-all-layer', 'Dashboard::loadAllLayer');

$routes->post('admin/drainase/coordinat', [Drainase::class, 'getCoordinat']);
$routes->post('simpan/pengaduan', [Pengaduan::class, 'simpan']);

$routes->POST('admin/modal/modal-pengaduan-image', [Modal::class, 'index']);
$routes->POST('admin/modal/modal-drainase-image', [Modal::class, 'index']);

$routes->group('admin', ['filter' => 'authGuard'], static function ($routes) {
    $routes->get('/', [Dashboard::class, 'index']);
    $routes->get('dashboard', [Dashboard::class, 'index']);

    $routes->get('distrik', [Distrik::class, 'index']);
    $routes->post('distrik', [Distrik::class, 'simpan'], ['as', 'simpan.distrik']);

    $routes->get('drainase', [Drainase::class, 'index']);
    $routes->post('drainase/simpan', [Drainase::class, 'simpan'], ['as', 'simpan_drainase']);
    $routes->post('drainase/import-layer', [Drainase::class, 'imporLayer']);
    $routes->post('drainase/export-excel', [Drainase::class, 'exportExcel']);
    $routes->get('drainase/edit/(:num)', [Drainase::class, 'edit/$1']);

    $routes->get('genangan-air', [GenanganAir::class, 'index']);
    $routes->post('genangan-air/import-layer', [GenanganAir::class, 'imporLayer']);
    $routes->get('genangan-air/edit/(:num)', [GenanganAir::class, 'edit/$1']);
    $routes->post('genangan-air/coordinat', [GenanganAir::class, 'getCoordinat']);
    $routes->post('genangan-air/load-img', [GenanganAir::class, 'loadImg']);
    $routes->post('genangan-air/simpan', [GenanganAir::class, 'simpan'], ['as', 'simpan_drainase']);

    $routes->get('layer', [Layer::class, 'index']);
    $routes->POST('layer/simpan', [Layer::class, 'simpan']);
    $routes->POST('layer-sub/simpan', [Layer::class, 'simpanSublayer']);
    $routes->get('layer/peta/(:num)', [Layer::class, 'edit/$1']);
    $routes->post('layer/coordinat', [Layer::class, 'getCoordinat']);
    $routes->get('layer/show-id/(:segment)', [Layer::class, 'showByID/$1']);
    $routes->post('layer/style', [Layer::class, 'updateStyle']);
    $routes->post('layer/legend', [Layer::class, 'updateLegend']);

    $routes->get('berita', [Berita::class, 'index']);
    $routes->get('berita/edit/(:num)', [Berita::class, 'edit/$1']);
    $routes->POST('berita/simpan', [Berita::class, 'simpan']);
    $routes->get('berita/detail/(:segment)',  [Berita::class, 'viewAdmin/$1']);
    $routes->post('berita/export-excel', [Berita::class, 'exportExcel']);

    $routes->get('pengaduan', [Pengaduan::class, 'index']);
    $routes->post('pengaduan/export-excel', [Pengaduan::class, 'exportExcel']);

    $routes->get('user', [User::class, 'index']);
    $routes->post('user/simpan', [User::class, 'simpan']);


    $routes->get('notifikasi', [Dashboard::class, 'notifPengaduan']);

    $routes->POST('modal/(:any)', [Modal::class, 'index']);
});


$routes->get('berita/detail/(:segment)',  [Berita::class, 'view/$1']);
$routes->get('berita',  [Berita::class, 'berita']);

$routes->group('datatable', function ($routes) {
    $routes->POST('/', [Datatable::class, 'index']);
    $routes->POST('server-side', [Datatable::class, 'serverSide']);
});

$routes->POST('datatable/d', [DHome::class, 'd']);
$routes->POST('select2/getdatakec/(:num)', [SelectDuo::class, 'getkec']);
$routes->POST('select2/getdatakel/(:num)', [SelectDuo::class, 'getkel']);

$routes->POST('delete', [Delete::class, 'index']);
