<?php

namespace App\Controllers\Admin;

use App\Models\M_user;
use App\Controllers\BaseController;

use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class User extends BaseController
{
    public function index()
    {
        $M_user = new M_user();
        $user = $M_user->findAll();

        $data['title'] = "User";
        $data['users'] = $user;

        return view('private/manuser/users', $data);
    }

    public function create()
    {
        $M_user = new UserModel();

        $M_user->withGroup($this->request->getVar('role'))->save([
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password_hash' => Password::hash('123456'),
            'active' => '1'
        ]);

        return redirect()->to(base_url('people'))->with('success', 'Data berhasil disimpan.');
    }

    public function update($id)
    {
        $M_user = new M_user();

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email')
        ];
        $M_user->update($id, $data);

        // Return a success message
        return redirect()->to(base_url('people'))->with('success', 'Data berhasil diupdate.');
    }


    public function changeStatus($id)
    {
        // Ambil data pengguna berdasarkan ID
        $M_user = new M_user();
        $user = $M_user->find($id);

        // Pastikan pengguna dengan ID tersebut ditemukan
        if ($user) {
            // Jika status awalnya 1, ubah menjadi 0; jika status awalnya 0, ubah menjadi 1
            $newStatus = ($user['active'] == '1') ? '0' : '1';

            // Lakukan pembaruan status di database menggunakan model
            $data = [
                'active' => $newStatus,
            ];

            $M_user->update($id, $data);

            // Kirim respons ke klien
            return $this->response->setJSON(['success' => true, 'new_status' => $newStatus]);
        }

        // Jika pengguna dengan ID tersebut tidak ditemukan, kirimkan respons kesalahan
        return $this->response->setJSON(['success' => false]);
    }

    public function delete($id)
    {
        $M_user = new M_user();

        $M_user->where('id', $id)->delete();

        // Return a success message
        return redirect()->to(base_url('people'))->with('success', 'Data berhasil dihapus.');
    }
}
