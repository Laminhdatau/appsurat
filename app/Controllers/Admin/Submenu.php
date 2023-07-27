<?php

namespace App\Controllers\Admin;

use App\Models\M_menu;
use App\Controllers\BaseController;
use App\Models\M_submenu;

class Submenu extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $query = $db->query('SELECT s.*, m.menu 
                            FROM t_sub_menu s
                            JOIN t_menu m ON s.id_menu = m.id_menu');

        $sub = $query->getResultArray();
        $m_menu = new M_menu();

        $menu = $m_menu->findAll();

        $data['title'] = "Sub Menu";
        $data['submenu'] = $sub;
        $data['menu'] = $menu;

        return view('private/manmenu/submenu', $data);
    }

    public function create()
    {
        $m_sub = new M_submenu();

        $data = [
            'id_sub_menu' => $this->request->getPost('id_sub_menu'),
            'id_menu' => $this->request->getPost('id_menu'),
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'is_active' => $this->request->getPost('is_active')
        ];

        $m_sub->insert($data);

        return redirect()->to(base_url('submenu'))->with('success', 'Data berhasil disimpan.');
    }

    public function update()
    {
        $m_sub = new M_submenu();
        $id = $this->request->getPost('id_sub_menu');
        $data = [
            'id_menu' => $this->request->getPost('id_menu'),
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'is_active' => $this->request->getPost('is_active')
        ];

        $m_sub->update($id, $data);

        // Return a success message
        return redirect()->to(base_url('submenu'))->with('success', 'Data berhasil diupdate.');
    }

    public function delete()
    {
        $m_sub = new M_submenu();
        $id = $this->request->getPost('id_sub_menu');

        $m_sub->where('id_sub_menu', $id)->delete();

        // Return a success message
        return redirect()->to(base_url('submenu'))->with('success', 'Data berhasil dihapus.');
    }
}
