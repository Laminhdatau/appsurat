<?php

namespace App\Controllers\Admin;

use App\Models\M_menu;
use App\Controllers\BaseController;

class Menu extends BaseController
{
    public function index()
    {
        $m_menu = new M_menu();
        $menu = $m_menu->findAll();

        $data['title'] = "Menu";
        $data['menu'] = $menu;

        return view('private/manmenu/menu', $data);
    }

    public function create()
    {
        $m_menu = new M_menu();

        $data = [
            'id_menu' => $this->request->getPost('id_menu'),
            'menu' => $this->request->getPost('menu')
        ];

        $m_menu->insert($data);

        return redirect()->to(base_url('menu'))->with('success', 'Data berhasil disimpan.');
    }

    public function update()
    {
        $m_menu = new M_menu();
        $id = $this->request->getPost('id_menu');
        $data = [
            'menu' => $this->request->getPost('menu')
        ];
        $m_menu->update($id, $data);

        // Return a success message
        return redirect()->to(base_url('menu'))->with('success', 'Data berhasil diupdate.');
    }

    public function delete()
    {
        $m_menu = new M_menu();
        $id = $this->request->getPost('id_menu');

        $m_menu->where('id_menu', $id)->delete();

        // Return a success message
        return redirect()->to(base_url('menu'))->with('success', 'Data berhasil dihapus.');
    }
}
