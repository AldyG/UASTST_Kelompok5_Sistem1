<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MahasiswaModel;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Pastikan dosen sudah login
        if(!session()->get('logged_in_dosen')){
          return redirect()->to('/');
        }
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->getMahasiswa();
        return view('mahasiswa_view', $data);
    }
}
