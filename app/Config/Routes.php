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

$routes->get('menu', 'Admin\\Menu::index',['filter' => 'role:sumin']);
$routes->post('createMenu', 'Admin\Menu::create',['filter' => 'role:sumin']);
$routes->post('updateMenu', 'Admin\\Menu::update',['filter' => 'role:sumin']);
$routes->post('deleteMenu', 'Admin\\Menu::delete',['filter' => 'role:sumin']);

$routes->get('submenu', 'Admin\\Submenu::index',['filter' => 'role:sumin']);
$routes->post('createSubMenu', 'Admin\Submenu::create',['filter' => 'role:sumin']);
$routes->post('updateSubMenu', 'Admin\\Submenu::update',['filter' => 'role:sumin']);
$routes->post('deleteSubMenu', 'Admin\\Submenu::delete',['filter' => 'role:sumin']);

$routes->post('konfirmasi', 'Users\\Lldikti\\Surat_masukl::konfirmasi',['filter' => 'permission:m-skd']);
$routes->post('konfirmasidis', 'Users\\Lldikti\\Surat_masukl::konfirmasidis',['filter' => 'permission:m-skd']);

$routes->post('disposisill', 'Users\\Lldikti\\Surat_masukl::disposisilldikti',['filter' => 'permission:m-smd']);


$routes->post('savesukerl', 'Users\\Lldikti\\Surat_keluarl::save',['filter' => 'permission:m-skd']);
$routes->post('konfirKirim/(:any)', 'Users\\Lldikti\\Surat_keluarl::konfirmasiSend/$1',['filter' => 'permission:m-skd']);


$routes->post('sendtoinst', 'Users\\Lldikti\\Surat_keluarl::sendToIns',['filter' => 'permission:m-skd']);
$routes->post('sendtogrup', 'Users\\Lldikti\\Surat_keluarl::sendAll',['filter' => 'permission:m-skd']);
$routes->post('dilihatoleh/(:any)', 'Users\\Lldikti\\Surat_keluarl::dilihatOleh/$1');


$routes->get('surattugas', 'Users\\Lldikti\\Surat_tugas::index',['filter' => 'permission:m-st']);
$routes->post('addSurgas', 'Users\\Lldikti\\Surat_tugas::createSurgas',['filter' => 'permission:m-st']);
$routes->post('saveDasar', 'Users\\Lldikti\\Surat_tugas::addDasar');
$routes->post('BookingNum', 'Users\\Lldikti\\Surat_tugas::BookingNumber',['filter' => 'permission:m-skd']);
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




$routes->get('suratmasukp', 'Users\\Pts\\Surat_masukp::index',['filter' => 'permission:m-smpts']);
$routes->get('suratkeluarp', 'Users\\Pts\\Surat_keluarp::index',['filter' => 'permission:m-skpts']);
$routes->post('savesukerp', 'Users\\Pts\\Surat_keluarp::save',['filter' => 'permission:m-skpts']);

$routes->get('getnotifikasil', 'Users\\Lldikti\\Surat_masukl::get_notifikasil');

// ======================

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
