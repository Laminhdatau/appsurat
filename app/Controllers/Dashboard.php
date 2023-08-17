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

        // Pastikan Anda telah menginisialisasi session dan autentikasi sebelum mengakses user()
        $user = user(); // Ini mengambil data pengguna yang sedang login melalui Myth/Auth

        if ($user) {
            $email->setTo($user->email);

            $email->setSubject('Pemberitahuan Login');
            $email->setMessage("Ada upaya login ke aplikasi dengan User Agent: $userAgent\n");

            if ($email->send()) {
                $data['email_sent'] = true; // Anda bisa gunakan ini untuk memberi tahu bahwa email terkirim
            } else {
                $data['email_sent'] = false; // Atau bahwa email gagal terkirim
            }
        }

        return view('dashboard', $data);
    }
}
