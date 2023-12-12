<?php namespace App\Controllers;

use App\Models\DosenModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function index()
    {
        // Tampilkan halaman login
        return view('login');
    }

    public function login()
    {
        $session = session();
        $model = new DosenModel();

        $NIDN = $this->request->getVar('NIDN');
        $password = $this->request->getVar('password');

        $data = $model->authenticate($NIDN, $password);

        if($data){
            $ses_data = [
                'NIDN'       => $data['NIDN'],
                'nama'       => $data['nama'],
                'isLoggedIn' => TRUE
            ];
            $session->set($ses_data);
            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('msg', 'NIDN atau Password salah');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
