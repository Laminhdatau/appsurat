<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

/**
 * -------------------------------------------------------------------
 * AUTOLOADER CONFIGURATION
 * -------------------------------------------------------------------
 *
 * This file defines the namespaces and class maps so the Autoloader
 * can find the files as needed.
 *
 * NOTE: If you use an identical key in $psr4 or $classmap, then
 * the values in this file will overwrite the framework's values.
 */
class Autoload extends AutoloadConfig
{
    /**
     * -------------------------------------------------------------------
     * Namespaces
     * -------------------------------------------------------------------
     * This maps the locations of any namespaces in your application to
     * their location on the file system. These are used by the autoloader
     * to locate files the first time they have been instantiated.
     *
     * The '/app' and '/system' directories are already mapped for you.
     * you may change the name of the 'App' namespace if you wish,
     * but this should be done prior to creating any namespaced classes,
     * else you will need to modify all of those classes for this to work.
     *
     * Prototype:
     *   $psr4 = [
     *       'CodeIgniter' => SYSTEMPATH,
     *       'App'         => APPPATH
     *   ];
     *
     * @var array<string, array<int, string>|string>
     * @phpstan-var array<string, string|list<string>>
     */
    public $psr4 = [
        'Config'      => APPPATH . 'Config',
        APP_NAMESPACE => APPPATH,
        'App'         => APPPATH,
        'Myth\Auth'   => APPPATH . 'ThirdParty/myth-auth/src',
    ];

    /**
     * -------------------------------------------------------------------
     * Class Map
     * -------------------------------------------------------------------
     * The class map provides a map of class names and their exact
     * location on the drive. Classes loaded in this manner will have
     * slightly faster performance because they will not have to be
     * searched for within one or more directories as they would if they
     * were being autoloaded through a namespace.
     *
     * Prototype:
     *   $classmap = [
     *       'MyClass'   => '/path/to/class/file.php'
     *   ];
     *
     * @var array<string, string>
     */
    public $classmap = [
        'M_user' => APPPATH . 'Models/M_user.php', 
        'M_verifikasi' => APPPATH . 'Models/M_verifikasi.php',
        'M_pegawai' => APPPATH . 'Models/M_pegawai.php',
        'M_pegawai_pts' => APPPATH . 'Models/M_pegawai_pts.php',
        'M_menu' => APPPATH . 'Models/M_menu.php',
        'M_akses_menu' => APPPATH . 'Models/M_akses_menu.php',
        'M_groups' => APPPATH . 'Models/M_groups.php',
        'M_instansi' => APPPATH . 'Models/M_instansi.php',
        'M_kop' => APPPATH . 'Models/M_kop.php',
        'M_instruksi' => APPPATH . 'Models/M_instruksi.php',
        'M_sifat' => APPPATH . 'Models/M_sifat.php',
        'M_submenu' => APPPATH . 'Models/M_submenu.php',
        'M_surat' => APPPATH . 'Models/M_surat.php',
    ];

    /**
     * -------------------------------------------------------------------
     * Files
     * -------------------------------------------------------------------
     * The files array provides a list of paths to __non-class__ files
     * that will be autoloaded. This can be useful for bootstrap operations
     * or for loading functions.
     *
     * Prototype:
     *   $files = [
     *       '/path/to/my/file.php',
     *   ];
     *
     * @var string[]
     * @phpstan-var list<string>
     */
    public $files = [];

    /**
     * -------------------------------------------------------------------
     * Helpers
     * -------------------------------------------------------------------
     * Prototype:
     *   $helpers = [
     *       'form',
     *   ];
     *
     * @var string[]
     * @phpstan-var list<string>
     */
    public $helpers = ['form'];
}
