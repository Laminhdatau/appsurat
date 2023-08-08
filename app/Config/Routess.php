<?php

namespace Config;

// Tentukan namespace, controller, dan method default
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');

// Nonaktifkan translate URI dashes
$routes->setTranslateURIDashes(false);

// Override 404 handling
$routes->set404Override();

// Rute untuk halaman utama
$routes->get('/', 'Dashboard::index');

// Tambahkan grup dengan filter 'role:sumin'
$routes->group('role:sumin', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('userpermission', 'Admin\\Aksesuser::index');
    $routes->post('adduserpermission', 'Admin\\Aksesuser::addUserPermission');
    $routes->post('removeuserpermission/(:num)/(:any)', 'Admin\\Aksesuser::removeUserPermission/$1/$2');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-skd'
$routes->group('permission:m-skd', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('suratkeluarl', 'Users\\Lldikti\\Surat_keluarl::index');
    $routes->get('formTambahSukerl', 'Users\\Lldikti\\Surat_keluarl::formTambahSuker');
    $routes->post('simpanSukerl', 'Users\\Lldikti\\Surat_keluarl::simpanSuker');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-skpts'
$routes->group('permission:m-skpts', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('suratkeluarl', 'Users\\Lldikti\\Surat_keluarl::index');
    $routes->get('formTambahSukerl', 'Users\\Lldikti\\Surat_keluarl::formTambahSuker');
    $routes->post('simpanSukerl', 'Users\\Lldikti\\Surat_keluarl::simpanSuker');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-smd'
$routes->group('permission:m-smd', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('suratmasukl', 'Users\\Lldikti\\Surat_masukl::index');
    $routes->get('suratmasukdis', 'Users\\Lldikti\\Surat_masukl::indexDisposisi');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-smpts'
$routes->group('permission:m-smpts', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('suratmasukp', 'Users\\Pts\\Surat_masukp::index');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'role:pegl'
$routes->group('role:pegl', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->post('disposisill', 'Users\\Lldikti\\Surat_masukl::disposisilldikti');
    $routes->post('konfirmasidis', 'Users\\Lldikti\\Surat_masukl::konfirmasidis');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'role:leadl'
$routes->group('role:leadl', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->post('Tte', 'Users\\Lldikti\\Surat_tugas::tandaTangan');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'role:admdikti'
$routes->group('role:admdikti', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('reffSurat', 'Users\\Lldikti\\Reffsurat::index');
    $routes->post('createReff', 'Users\\Lldikti\\Reffsurat::create');
    $routes->post('updateReff', 'Users\\Lldikti\\Reffsurat::update');
    $routes->post('deleteReff', 'Users\\Lldikti\\Reffsurat::delete');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-skd'
$routes->group('permission:m-skd', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('suratkeluarl', 'Users\\Lldikti\\Surat_keluarl::index');
    $routes->get('formTambahSukerl', 'Users\\Lldikti\\Surat_keluarl::formTambahSuker');
    $routes->post('simpanSukerl', 'Users\\Lldikti\\Surat_keluarl::simpanSuker');
    $routes->get('formUbahSukerl/(:any)', 'Users\\Lldikti\\Surat_keluarl::formUbahSuker/$1');
    $routes->post('updateSukerl/(:any)', 'Users\\Lldikti\\Surat_keluarl::updateSuker/$1');
    $routes->post('getCurStep/(:any)', 'Users\\Pts\\Surat_keluarp::getCurStep/$1');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-nd'
$routes->group('permission:m-nd', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('notadinas', 'Users\\Lldikti\\Nota_dinas::index');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-st'
$routes->group('permission:m-st', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('surattugas', 'Users\\Lldikti\\Surat_tugas::index');
    $routes->get('surattugas/(:any)', 'Users\\Lldikti\\Surat_tugas::index/$1');
    $routes->post('addSurgas', 'Users\\Lldikti\\Surat_tugas::createSurgas');
    $routes->post('saveDasar', 'Users\\Lldikti\\Surat_tugas::addDasar');
    $routes->post('BookingNum', 'Users\\Lldikti\\Surat_tugas::BookingNumber');
    $routes->post('addSurgasPegawai', 'Users\\Lldikti\\Surat_tugas::addPegawaiSpt');
    $routes->post('updateSurgasPegawai', 'Users\\Lldikti\\Surat_tugas::updatePegawaiSpt');
    $routes->post('ubahSurgas/(:any)', 'Users\\Lldikti\\Surat_tugas::updateSurgas/$1');
    $routes->post('uprovment', 'Users\\Lldikti\\Surat_tugas::addverifikator');
    $routes->post('verify', 'Users\\Lldikti\\Surat_tugas::verify');
    $routes->get('lihatTte(:any)', 'Users\\Lldikti\\Surat_tugas::showDocumentTte/$1');
    $routes->get('DetailSuratPdf/(:any)', 'Users\\Lldikti\\Surat_tugas::DetailSuratPdf/$1');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-smpts'
$routes->group('permission:m-smpts', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->post('dilihatolehp/(:any)', 'Users\\Pts\\Surat_masukp::dilihatOleh/$1');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-smd'
$routes->group('permission:m-smd', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->post('dilihatolehl/(:any)', 'Users\\Lldikti\\Surat_masukl::dilihatOleh/$1');
    $routes->post('konfirmasi', 'Users\\Lldikti\\Surat_masukl::konfirmasi');
    $routes->get('formDisposisi/(:any)', 'Users\\Lldikti\\Surat_masukl::formDisposisi/$1');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'permission:m-skpts'
$routes->group('permission:m-skpts', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->post('konfirKirim/(:any)', 'Users\\Lldikti\\Surat_keluarl::konfirmasiSend/$1');
    $routes->post('sendtoinst', 'Users\\Lldikti\\Surat_keluarl::sendToIns');
    $routes->post('sendtogrup', 'Users\\Lldikti\\Surat_keluarl::sendAll');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'role:leadl'
$routes->group('role:leadl', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->post('Tte', 'Users\\Lldikti\\Surat_tugas::tandaTangan');
    // ... tambahkan rute lainnya ...
});

// Tambahkan grup dengan filter 'role:admdikti'
$routes->group('role:admdikti', function ($routes) {
    // Tambahkan rute yang sesuai di sini
    $routes->get('reffSurat', 'Users\\Lldikti\\Reffsurat::index');
    $routes->post('createReff', 'Users\\Lldikti\\Reffsurat::create');
    $routes->post('updateReff', 'Users\\Lldikti\\Reffsurat::update');
    $routes->post('deleteReff', 'Users\\Lldikti\\Reffsurat::delete');
    // ... tambahkan rute lainnya ...
});

// Jika ada Routes.php khusus di folder environment, maka tambahkan juga
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
