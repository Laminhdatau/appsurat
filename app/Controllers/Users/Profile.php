<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\M_pegawai;
use App\Models\M_user;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Controllers\AuthController;
use Myth\Auth\Password;

class Profile extends BaseController
{


    public function index()
    {
        $m_user = new M_user();
        $uri = $this->request->uri->getSegment(2); 
        
        $users = $m_user->getUsers($uri); // Menghapus ->getRow() untuk mendapatkan semua hasil
 
        $data = [
            'title' => 'Profile',
            'users' => $users
        ];
        return view('public/profile', $data);
    }

    public function ubahProfile($id, $idp)
    {
        $M_user = new M_user();
        $M_pegawai = new M_pegawai();


        $du = [
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username')
        ];

        $user_image = $this->request->getFile('user_image');

        if ($user_image && $user_image->isValid() && !$user_image->hasMoved()) {
            $newName = $user_image->getRandomName();
            $user_image->move('assets/img', $newName);
            $du['user_image'] = $newName;
        }

        $M_user->updateUser($id, $du);

        $dp = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap')
        ];

        $M_pegawai->updatePegawai($idp, $dp);

        return redirect()->to(base_url(''))->with('success', 'Data berhasil disimpan.');
    }







    public function formPassword()
    {

        $data = [
            'title' => 'Ubah Password'

        ];
        return view('public/pwd', $data);
    }


    public function changePassword()
    {
        $userModel = new UserModel();
        $user = $userModel->find(user_id());

        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min_length[8]|strong_password',
            'confirm_password' => 'required|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('change-password')->withInput()->with('errors', $this->validator->getErrors());
        }

        $oldPassword = $this->request->getPost('old_password');
        if (!$userModel->verifyPassword($user->email, $oldPassword)) {
            return redirect()->to('change-password')->withInput()->with('errors', ['old_password' => 'Old password is incorrect.']);
        }

        $newPassword = $this->request->getPost('new_password');
        $userModel->update($user->id, ['password' => $newPassword]);

        return redirect()->to('profile')->with('message', 'Password changed successfully.');
    }
}
