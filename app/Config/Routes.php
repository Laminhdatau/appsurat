<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();


$routes->get('/', 'Dashboard::index');

$routes->get('suratmasukl', 'Users\\Lldikti\\Surat_masukl::index',['filter' => 'permission:m-smd']);

$routes->get('suratkeluarl', 'Users\\Lldikti\\Surat_keluarl::index', ['filter' => 'permission:m-skd']);

$routes->get('suratmasukdis', 'Users\\Lldikti\\Surat_masukl::indexDisposisi', ['filter' => 'role:pegl']);


$routes->get('profile', 'Users\\Profile::index');
$routes->get('menu', 'Admin\\Menu::index');
$routes->post('createMenu', 'Admin\Menu::create');
$routes->post('updateMenu', 'Admin\\Menu::update');
$routes->post('deleteMenu', 'Admin\\Menu::delete');

$routes->get('submenu', 'Admin\\Submenu::index');
$routes->post('createSubMenu', 'Admin\Submenu::create');
$routes->post('updateSubMenu', 'Admin\\Submenu::update');
$routes->post('deleteSubMenu', 'Admin\\Submenu::delete');

$routes->post('konfirmasi', 'Users\\Lldikti\\Surat_masukl::konfirmasi');

$routes->post('disposisill', 'Users\\Lldikti\\Surat_masukl::disposisilldikti');


// $routes->get('suratkeluarl', 'Users\\Lldikti\\Surat_keluarl::index');
$routes->post('savesukerl', 'Users\\Lldikti\\Surat_keluarl::save');
$routes->post('konfirKirim/(:any)', 'Users\\Lldikti\\Surat_keluarl::konfirmasiSend/$1');


$routes->post('sendtoinst', 'Users\\Lldikti\\Surat_keluarl::sendToIns');
$routes->post('sendtogrup', 'Users\\Lldikti\\Surat_keluarl::sendAll');
$routes->post('dilihatoleh', 'Users\\Lldikti\\Surat_keluarl::dilihatOleh');


$routes->get('surattugas', 'Users\\Lldikti\\Surat_tugas::index');
$routes->post('addSurgas', 'Users\\Lldikti\\Surat_tugas::createSurgas');
$routes->post('saveDasar', 'Users\\Lldikti\\Surat_tugas::addDasar');
$routes->post('BookingNum', 'Users\\Lldikti\\Surat_tugas::BookingNumber');
$routes->post('addSurgasPegawai', 'Users\\Lldikti\\Surat_tugas::addPegawaiSpt');
$routes->post('updateSurgasPegawai', 'Users\\Lldikti\\Surat_tugas::updatePegawaiSpt');
$routes->post('ubahSurgas/(:any)', 'Users\\Lldikti\\Surat_tugas::updateSurgas/$1');

$routes->post('Tte', 'Users\\Lldikti\\Surat_tugas::tandaTangan');
$routes->post('uprovment', 'Users\\Lldikti\\Surat_tugas::addverifikator');
$routes->post('verify', 'Users\\Lldikti\\Surat_tugas::verify');
$routes->get('lihatTte(:any)', 'Users\\Lldikti\\Surat_tugas::showDocumentTte/$1');
$routes->get('notadinas', 'Users\\Lldikti\\Nota_dinas::index');
$routes->post('SeeTo/(:any)', 'Users\\Lldikti\\Surat_tugas::SeeTo/$1');
$routes->get('DetailSuratPdf/(:any)', 'Users\\Lldikti\\Surat_tugas::DetailSuratPdf/$1');


$routes->get('reffSurat', 'Users\\Lldikti\\Reffsurat::index');
$routes->post('createReff', 'Users\Lldikti\\Reffsurat::create');
$routes->post('updateReff', 'Users\\Lldikti\\Reffsurat::update');
$routes->post('deleteReff', 'Users\\Lldikti\\Reffsurat::delete');
$routes->get('getKodeSurat', 'Users\\Lldikti\\Surat_tugas::getKodeSurat');




$routes->get('suratmasukp', 'Users\\Pts\\Surat_masukp::index');
$routes->get('suratkeluarp', 'Users\\Pts\\Surat_keluarp::index');
$routes->post('savesukerp', 'Users\\Pts\\Surat_keluarp::save');

$routes->get('getnotifikasil', 'Users\\Lldikti\\Surat_masukl::get_notifikasil');

// ======================

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
