<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\ConnectionInterface;

class Levelakses extends BaseController
{
    protected $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }
    public function index()
    {
        $data['title'] = 'Akses Level';

        $data['user'] = $this->db->table('t_user')->getWhere(['email' => session('email')])->getRowArray();
        $id_level = $this->request->getPost('id_level');
        $data['level'] = $this->db->table('t_level')->getWhere(['id_level' => $id_level])->getRowArray();

        $query = $this->db->table('t_menu')->where('id_level !=', 1)->get();
        $data['menu'] = $query->getResultArray();

        return view('private/manmenu/levelakses', $data);
    }

    public function ubahAkses()
    {
        $id_menu = $this->request->getPost('id_menu');
        $id_level = $this->request->getPost('id_level');

        $data = [
            'id_level' => $id_level,
            'id_menu' => $id_menu
        ];

        $query = $this->db->table('t_akses_menu')->getWhere($data);

        if ($query->getNumRows() < 1) {
            $this->db->table('t_akses_menu')->insert($data);
        } else {
            $this->db->table('t_akses_menu')->delete($data);
        }

        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }
}
