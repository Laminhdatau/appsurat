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



// SUPER ADMIN


$routes->get('userpermission', 'Admin\\Aksesuser::index', ['filter' => 'role:sumin']);
$routes->post('adduserpermission', 'Admin\\Aksesuser::addUserPermission', ['filter' => 'role:sumin']);
$routes->post('removeuserpermission/(:num)/(:any)', 'Admin\\Aksesuser::removeUserPermission/$1/$2', ['filter' => 'role:sumin']);

$routes->get('gruppermission', 'Admin\\Aksesuser::grup', ['filter' => 'role:sumin']);
$routes->post('addgruppermission', 'Admin\\Aksesuser::addGroupPermission', ['filter' => 'role:sumin']);
$routes->post('removegruppermission/(:num)/(:any)', 'Admin\\Aksesuser::removeGrupPermission/$1/$2', ['filter' => 'role:sumin']);

$routes->get('leveluser', 'Admin\\Aksesuser::level');
$routes->post('adduserlevel', 'Admin\\Aksesuser::addUserLevel');
$routes->post('removeuserlevel/(:num)/(:any)', 'Admin\\Aksesuser::removeUserLevel/$1/$2');

$routes->get('pegawaiuserp', 'Admin\\Pegawaiuser::userpegawaip');
$routes->post('adduserpegawaip', 'Admin\\Pegawaiuser::addPegawaiUserp');
$routes->post('removepegawaiuserp/(:num)/(:any)', 'Admin\\Pegawaiuser::removePegawaiUserp/$1/$2');

$routes->get('pegawaiuserl', 'Admin\\Pegawaiuser::index');
$routes->post('adduserpegawail', 'Admin\\Pegawaiuser::addPegawaiUserl');
$routes->post('removepegawaiuserl/(:num)/(:any)', 'Admin\\Pegawaiuser::removePegawaiUserl/$1/$2');

// END

















$routes->get('suratkeluarl', 'Users\\Lldikti\\Surat_keluarl::index', ['filter' => 'permission:m-skd']);

$routes->get('formTambahSukerl', 'Users\\Lldikti\\Surat_keluarl::formTambahSuker');
$routes->post('simpanSukerl', 'Users\\Lldikti\\Surat_keluarl::simpanSuker', ['filter' => 'permission:m-skd']);

$routes->get('formUbahSukerl/(:any)', 'Users\\Lldikti\\Surat_keluarl::formUbahSuker/$1');
$routes->post('updateSukerl/(:any)', 'Users\\Lldikti\\Surat_keluarl::updateSuker/$1');


$routes->post('getCurStep/(:any)', 'Users\\Pts\\Surat_keluarp::getCurStep/$1');




$routes->get('suratkeluarp', 'Users\\Pts\\Surat_keluarp::index', ['filter' => 'permission:m-skpts']);

$routes->get('formTambahSukerp', 'Users\\Pts\\Surat_keluarp::formTambahSuker');
$routes->post('simpanSukerp', 'Users\\Pts\\Surat_keluarp::simpanSuker', ['filter' => 'permission:m-skpts']);

$routes->get('formUbahSukerp/(:any)', 'Users\\Pts\\Surat_keluarp::formUbahSuker/$1');
$routes->post('updateSukerp/(:any)', 'Users\\Pts\\Surat_keluarp::updateSuker/$1');
$routes->post('hapusSuratp/(:any)', 'Users\\Pts\\Surat_keluarp::deleteSuker/$1', ['filter' => 'permission:m-skpts']);
$routes->post('hapusSuratl/(:any)', 'Users\\Lldikti\\Surat_keluarl::deleteSuker/$1', ['filter' => 'permission:m-skd']);


$routes->post('validasiKirim/(:any)', 'Users\\Pts\\Surat_keluarp::validasiKirim/$1', ['filter' => 'permission:m-skpts']);



$routes->get('suratmasukl', 'Users\\Lldikti\\Surat_masukl::index', ['filter' => 'permission:m-smd']);


$routes->get('suratmasukdis', 'Users\\Lldikti\\Surat_masukl::indexDisposisi', ['filter' => 'role:pegl']);


$routes->get('profile', 'Users\\Profile::index');

$routes->get('menu', 'Admin\\Menu::index', ['filter' => 'role:sumin']);
$routes->post('createMenu', 'Admin\Menu::create', ['filter' => 'role:sumin']);
$routes->post('updateMenu', 'Admin\\Menu::update', ['filter' => 'role:sumin']);
$routes->post('deleteMenu', 'Admin\\Menu::delete', ['filter' => 'role:sumin']);

$routes->get('submenu', 'Admin\\Submenu::index', ['filter' => 'role:sumin']);
$routes->post('createSubMenu', 'Admin\Submenu::create', ['filter' => 'role:sumin']);
$routes->post('updateSubMenu', 'Admin\\Submenu::update', ['filter' => 'role:sumin']);
$routes->post('deleteSubMenu', 'Admin\\Submenu::delete', ['filter' => 'role:sumin']);

$routes->post('konfirmasi', 'Users\\Lldikti\\Surat_masukl::konfirmasi', ['filter' => 'permission:m-skd']);

$routes->post('konfirmasidis', 'Users\\Lldikti\\Surat_masukl::konfirmasidis');

$routes->post('disposisill', 'Users\\Lldikti\\Surat_masukl::disposisilldikti', ['filter' => 'permission:m-smd']);
$routes->get('formDisposisi/(:any)', 'Users\\Lldikti\\Surat_masukl::formDisposisi/$1', ['filter' => 'permission:m-smd']);



$routes->post('konfirKirim/(:any)', 'Users\\Lldikti\\Surat_keluarl::konfirmasiSend/$1', ['filter' => 'permission:m-skd']);


$routes->post('sendtoinst', 'Users\\Lldikti\\Surat_keluarl::sendToIns', ['filter' => 'permission:m-skd']);
$routes->post('sendtogrup', 'Users\\Lldikti\\Surat_keluarl::sendAll', ['filter' => 'permission:m-skd']);

$routes->post('dilihatolehp/(:any)', 'Users\\Pts\\Surat_masukp::dilihatOleh/$1', ['filter' => 'permission:m-smpts']);
$routes->post('dilihatolehl/(:any)', 'Users\\Lldikti\\Surat_masukl::dilihatOleh/$1', ['filter' => 'permission:m-smd']);


$routes->get('surattugas', 'Users\\Lldikti\\Surat_tugas::index', ['filter' => 'permission:m-st']);
$routes->get('surattugas/(:any)', 'Users\\Lldikti\\Surat_tugas::index/$1', ['filter' => 'permission:m-st']);

$routes->post('addSurgas', 'Users\\Lldikti\\Surat_tugas::createSurgas', ['filter' => 'permission:m-st']);
$routes->post('saveDasar', 'Users\\Lldikti\\Surat_tugas::addDasar', ['filter' => 'permission:m-st']);
$routes->post('BookingNum', 'Users\\Lldikti\\Surat_tugas::BookingNumber', ['filter' => 'permission:m-skd']);
$routes->post('addSurgasPegawai', 'Users\\Lldikti\\Surat_tugas::addPegawaiSpt', ['filter' => 'permission:m-st']);
$routes->post('updateSurgasPegawai', 'Users\\Lldikti\\Surat_tugas::updatePegawaiSpt', ['filter' => 'permission:m-st']);
$routes->post('ubahSurgas/(:any)', 'Users\\Lldikti\\Surat_tugas::updateSurgas/$1', ['filter' => 'permission:m-st']);

$routes->post('Tte', 'Users\\Lldikti\\Surat_tugas::tandaTangan', ['filter' => 'role:leadl']);
$routes->post('uprovment', 'Users\\Lldikti\\Surat_tugas::addverifikator', ['filter' => 'permission:m-st']);
$routes->post('verify', 'Users\\Lldikti\\Surat_tugas::verify', ['filter' => 'role:pegl']);
$routes->get('lihatTte(:any)', 'Users\\Lldikti\\Surat_tugas::showDocumentTte/$1', ['filter' => 'permission:m-st']);
$routes->get('notadinas', 'Users\\Lldikti\\Nota_dinas::index', ['filter' => 'permission:m-nd']);
$routes->post('SeeTo/(:any)', 'Users\\Lldikti\\Surat_tugas::SeeTo/$1', ['filter' => 'permission:m-st']);
$routes->get('DetailSuratPdf/(:any)', 'Users\\Lldikti\\Surat_tugas::DetailSuratPdf/$1', ['filter' => 'permission:m-st']);


$routes->get('reffSurat', 'Users\\Lldikti\\Reffsurat::index', ['filter' => 'role:admdikti']);
$routes->post('createReff', 'Users\Lldikti\\Reffsurat::create', ['filter' => 'role:admdikti']);
$routes->post('updateReff', 'Users\\Lldikti\\Reffsurat::update', ['filter' => 'role:admdikti']);
$routes->post('deleteReff', 'Users\\Lldikti\\Reffsurat::delete', ['filter' => 'role:admdikti']);
$routes->get('getKodeSurat', 'Users\\Lldikti\\Surat_tugas::getKodeSurat', ['filter' => 'role:admdikti']);




$routes->get('suratmasukp', 'Users\\Pts\\Surat_masukp::index', ['filter' => 'permission:m-smpts']);

$routes->get('notif', 'Users\\Pts\\Surat_masukp::get_notifikasi');

// ======================

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
