<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $email = \Config\Services::email();
        $userAgent = $this->request->getUserAgent();

        $email->setFrom('devminjeey.web@gmail.com', 'Persuratan LLDIKTI');
        $email->setTo(user()->email);

        $email->setSubject('Pemberitahuan Login');
        $email->setMessage("Ada upaya login ke aplikasi dengan User Agent: $userAgent\n");

        $data['email'] = $email->send();
        return view('dashboard', $data);
    }
}
