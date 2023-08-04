<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_aksesgrup;
use App\Models\M_aksesuser;
use App\Models\M_leveluser;
use App\Models\M_groups;
use App\Models\M_user;
use App\Models\M_permisi;

class Aksesuser extends BaseController
{

    public function index()
    {
        $M_aksesuser = new M_aksesuser();
        $M_user = new M_user();
        $M_permisi = new M_permisi();
        $permissions = $M_aksesuser->getUserPermissions();
        $user = $M_user->findAll();
        $permisi = $M_permisi->findAll();

        $data = [
            'title' => 'User Permissions',
            'permissions' => $permissions,
            'users' => $user,
            'permisi' => $permisi
        ];

        return view('private/manuser/ijinuser', $data);
    }

    public function addUserPermission()
    {
        $user_id = $this->request->getPost('user');
        $permission_id = $this->request->getPost('akses');

        $M_aksesuser = new M_aksesuser();
        $data = [
            'user_id' => $user_id,
            'permission_id' => $permission_id
        ];

        $M_aksesuser->insert($data);
        return redirect()->to('userpermission');
    }

    public function removeUserPermission($idu, $pid)
    {
        $M_aksesuser = new M_aksesuser();
        $M_aksesuser->where('user_id', $idu)->where('permission_id', $pid)->delete();

        return redirect()->to('userpermission');
    }





    public function grup()
    {
        $M_aksesgrup = new M_aksesgrup();
        $M_groups = new M_groups();
        $M_permisi = new M_permisi();
        $permissions = $M_aksesgrup->getGrupPermissions();
        $grup = $M_groups->findAll();
        $permisi = $M_permisi->findAll();

        $data = [
            'title' => 'User Permissions',
            'permissions' => $permissions,
            'grup' => $grup,
            'permisi' => $permisi
        ];

        return view('private/manuser/ijingrup', $data);
    }

    public function addGrupPermission()
    {
        $grup_id = $this->request->getPost('grup');
        $permission_id = $this->request->getPost('akses');

        $M_aksesgrup = new M_aksesgrup();
        $data = [
            'group_id' => $grup_id,
            'permission_id' => $permission_id
        ];

        $M_aksesgrup->insert($data);
        return redirect()->to('userpermission');
    }

    public function removeGrupPermission($id1, $id2)
    {
        $M_aksesgrup = new M_aksesgrup();
        $M_aksesgrup->where('group_id', $id1)->where('permission_id', $id2)->delete();
        return redirect()->to('userpermission');
    }




    public function level()
    {
        $M_leveluser = new M_leveluser();

        $lvl = $M_leveluser->getLevelUser();

        $M_groups = new M_groups();
        $M_user = new M_user();

        $grup = $M_groups->findAll();
        $user = $M_user->findAll();

        $data = [
            'title' => 'User Level',
            'level' => $lvl,
            'grups' => $grup,
            'users' => $user
        ];

        return view('private/manuser/leveluser', $data);
    }

    public function addUserLevel()
    {
        $grup_id = $this->request->getPost('grup');
        $user_id = $this->request->getPost('user');

        $M_leveluser = new M_leveluser();
        $data = [
            'group_id' => $grup_id,
            'user_id' => $user_id
        ];

        $M_leveluser->insert($data);
        return redirect()->to('leveluser');
    }

    public function removeUserLevel($id1, $id2)
    {
        $M_leveluser = new M_leveluser();
        $M_leveluser->where('user_id', $id1)->where('group_id', $id2)->delete();
        return redirect()->to('leveluser');
    }
}
