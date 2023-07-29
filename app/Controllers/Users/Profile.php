<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;

class Profile extends BaseController
{


    public function index()
    {

        $db = db_connect();
        $query = $db->query("SELECT * from v_ulevel u
        ,t_user_pegawai up 
        ,v_pegawai p
        where up.id_user=u.id_user
        and p.id_pegawai=up.id_pegawai
        and u.id_user='" . idUser() . "'
        ");
        $users = $query->getRow();
        $data = [
            'title' => 'Profile',
            'users' => $users
        ];


        // dd($data);

        return view('public/profile', $data);
    }

    // public function create()
    // {
    //     $pw = $this->request->getPost('password');
    //     $pwhash = password_hash("$pw", PASSWORD_DEFAULT);

    //     $data = [
    //         'id' => $this->request->getPost('id_user'),
    //         'username' => $this->request->getPost('username'),
    //         'email' => $this->request->getPost('email'),
    //         'password_hash' => $pwhash,
    //         'active' => 1
    //     ];

    //     // dd($data);
    //     $M_user->createUser($data);

    //     return redirect()->to(base_url('pengguna'))->with('success', 'User created successfully.');
    // }

    // public function edit($id)
    // {
    //     $M_user = new M_user();
    //     $user = $M_user->getUserById($id);

    //     if (!$user) {
    //         return redirect()->back()->with('error', 'User not found.');
    //     }

    //     $data = [
    //         'title' => 'Edit User',
    //         'user' => $user
    //     ];

    //     return view('admin/user/edit', $data);
    // }

    // public function update($id)
    // {
    //     $M_user = new M_user();

    //     $data = [
    //         'username' => $this->request->getPost('username'),
    //         'email' => $this->request->getPost('email'),
    //         'password' => $this->request->getPost('password')
    //     ];

    //     $M_user->updateUser($id, $data);

    //     return redirect()->to(base_url('admin/user'))->with('success', 'User updated successfully.');
    // }

    // public function delete($id)
    // {
    //     $M_user = new M_user();
    //     $M_user->deleteUser($id);

    //     return redirect()->to(base_url('admin/user'))->with('success', 'User deleted successfully.');
    // }
}
