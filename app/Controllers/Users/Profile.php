<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;

class Profile extends BaseController
{


    public function index()
    {
        $db=db_connect();
        $query = $db->query("SELECT * from v_ulevel");

        $users = $query->getResultArray();

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
