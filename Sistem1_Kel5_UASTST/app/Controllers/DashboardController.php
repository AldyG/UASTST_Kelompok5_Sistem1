<?php namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\MataKuliahModel;
use App\Models\MatkulDosenModel;
use App\Models\MatkulMahasiswaModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in_dosen')) {
            return redirect()->to('/logout');
        }
        $nidn = $session->get('logged_in_dosen')['nidn']; // diasumsikan NIDN tersimpan di session saat login

        $dosenModel = new DosenModel();
        // $matkulDosenModel = new MatkulDosenModel();
        // $mataKuliahModel = new MataKuliahModel();
        // $matkulMahasiswaModel = new MatkulMahasiswaModel();

        // $dosen = $dosenModel->find($nidn);
        // $mataKuliahDosen = $matkulDosenModel->where('nidn_dosen', $nidn)->findAll();

        // $mataKuliahData = [];
        // foreach ($mataKuliahDosen as $matkul) {
        //     $kodeMatkul = $matkul['kode_matkul'];
        //     $mataKuliah = $mataKuliahModel->find($kodeMatkul);

        //     // Ubah query untuk mahasiswa
        //     $mahasiswaMatkul = $matkulMahasiswaModel->where('kode_matkul', $kodeMatkul)->findAll();

        //     $mataKuliahData[] = [
        //         'mata_kuliah' => $mataKuliah,
        //         'mahasiswa' => $mahasiswaMatkul
        //     ];
        // }

        // return view('dashboard', [
        //     'dosen' => $dosen,
        //     'mataKuliahData' => $mataKuliahData
        // ]);

        $matkulDosenModel = new MatkulDosenModel();
        $mataKuliahModel = new MataKuliahModel();
          $dosen = $dosenModel->find($nidn);
        // Dapatkan daftar mata kuliah yang diajar oleh dosen
        $matkulDosen = $matkulDosenModel->where('nidn_dosen', $nidn)->findAll();
        $daftarMataKuliah = [];
        foreach ($matkulDosen as $matkul) {
            $kodeMatkul = $matkul['kode_matkul'];
            $mataKuliah = $mataKuliahModel->find($kodeMatkul);
            if ($mataKuliah) {
                $daftarMataKuliah[] = $mataKuliah;
            }
        }

        return view('dashboard', [
            'dosen' => $dosen,
            'daftarMataKuliah' => $daftarMataKuliah
        ]);
    }
}
