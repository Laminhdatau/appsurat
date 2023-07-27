<?php

namespace App\Controllers\Users\Lldikti;

use App\Controllers\BaseController;
use App\Models\M_reff;

class Reffsurat extends BaseController
{
    public function index()
    {
        $m_reff = new M_reff();

        $reff = $m_reff->findAll();


        $data['title'] = "Referensi Surat";
        $data['reff'] = $reff;

        return view('private/mansurat/reffsurat', $data);
    }

    public function create()
    {
        $m_reff = new M_reff();

        $data = [
            'id_reff_surat' => $this->request->getPost('id_reff_surat'),
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'perihal' => $this->request->getPost('perihal')

        ];

        $m_reff->insert($data);

        return redirect()->to(base_url('reffSurat'))->with('success', 'Data berhasil');
    }

    public function update()
    {
        $m_reff = new M_reff();
        $id = $this->request->getPost('id_reff_surat');

        $data = [

            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'perihal' => $this->request->getPost('perihal')

        ];

        $m_reff->update($id, $data);

        return redirect()->to(base_url('reffSurat'))->with('success', 'Data Diupdate');
    }

    public function delete()
    {
        $m_reff = new M_reff();
        $id = $this->request->getPost('id_reff_surat');

        $m_reff->where('id_reff_surat', $id)->delete();
        return redirect()->to(base_url('reffSurat'))->with('success', 'Data Terhapus');
    }
}
