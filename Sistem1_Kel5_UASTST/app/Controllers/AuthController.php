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
        $nidn = $this->request->getPost('nidn');
        $password = $this->request->getPost('password');

        $model = new DosenModel();

        $dosen = $model->validateDosen($nidn, $password);
        if ($dosen) {
            // Simpan data user ke session
            session()->set('logged_in_dosen', $dosen);
            return redirect()->to('/dashboard');
        } else {
            // Handle login gagal
            // return redirect()->back()->with('error', 'NIDN atau Password salah');
            return redirect()->to('/dashboarddwd');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
