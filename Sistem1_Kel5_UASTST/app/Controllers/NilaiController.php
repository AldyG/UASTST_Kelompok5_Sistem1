<?php namespace App\Controllers;

use App\Models\NilaiModel;
use CodeIgniter\Controller;

use App\Models\DosenModel;
use App\Models\MataKuliahModel;
use App\Models\MatkulDosenModel;
use App\Models\MatkulMahasiswaModel;

class NilaiController extends Controller
{
    private function hitungNilaiAkhir($nilaiMahasiswa)
    {
        $totalNilaiTugas = 0;
        $jumlahTugas = 0;
        $nilaiUTS = 0;
        $nilaiUAS = 0;

        foreach ($nilaiMahasiswa as $nilai) {
            if ($nilai['jenis'] === 'tugas') {
                $totalNilaiTugas += $nilai['nilai'];
                $jumlahTugas++;
            } elseif ($nilai['jenis'] === 'uts') {
                $nilaiUTS = $nilai['nilai'];
            } elseif ($nilai['jenis'] === 'uas') {
                $nilaiUAS = $nilai['nilai'];
            }
        }

        $rataRataTugas = $jumlahTugas > 0 ? $totalNilaiTugas / $jumlahTugas : 0;
        $nilaiAkhir = (0.2 * $rataRataTugas) + (0.4 * $nilaiUTS) + (0.4 * $nilaiUAS);

        return $nilaiAkhir;
    }

    public function dashboard()
    {
        // Pastikan dosen sudah login
        if(!session()->get('logged_in_dosen')){
            return redirect()->to('/');
        }

        // Tampilkan dashboard
        return view('dashboard');
    }

    public function input($kodeMatkul)
    {
        $mataKuliahModel = new MataKuliahModel();
        $matkulMahasiswaModel = new MatkulMahasiswaModel();

        // Dapatkan informasi mata kuliah berdasarkan kode
        $mataKuliah = $mataKuliahModel->find($kodeMatkul);

        // Dapatkan daftar mahasiswa yang mengambil mata kuliah ini
        $mahasiswaMatkul = $matkulMahasiswaModel->where('kode_matkul', $kodeMatkul)->findAll();

        return view('input_nilai', [
            'mataKuliah' => $mataKuliah,
            'mahasiswaMatkul' => $mahasiswaMatkul,
            'kodeMatkul' => $kodeMatkul // Kirimkan juga kode mata kuliah ke view
        ]);
    }

    public function simpanNilai()
    {
        $penilaianModel = new NilaiModel();

        $data = [
            'jenis' => $this->request->getPost('kategori_nilai'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'nilai' => $this->request->getPost('nilai'),
            'nim_mahasiswa' => $this->request->getPost('mahasiswa_id'),
            'kode_matkul' => $this->request->getPost('kode_matkul')
        ];

        $penilaianModel->save($data);

        // Redirect atau tampilkan pemberitahuan setelah menyimpan
        return redirect()->to('/dashboard'); 
    }

    public function lihatNilai($kodeMatkul)
    {
        $penilaianModel = new NilaiModel();
        $nilaiMahasiswa = $penilaianModel->where('kode_matkul', $kodeMatkul)->findAll();

        // Hitung nilai akhir untuk setiap mahasiswa
        $nilaiAkhirMahasiswa = [];
        foreach ($nilaiMahasiswa as $nilai) {
            $nim = $nilai['nim_mahasiswa'];
            if (!isset($nilaiAkhirMahasiswa[$nim])) {
                $nilaiMahasiswaPerNIM = $penilaianModel->where('kode_matkul', $kodeMatkul)
                                                       ->where('nim_mahasiswa', $nim)
                                                       ->findAll();
                $nilaiAkhirMahasiswa[$nim] = $this->hitungNilaiAkhir($nilaiMahasiswaPerNIM);
            }
        }

        return view('lihat_nilai', [
            'nilaiMahasiswa' => $nilaiMahasiswa,
            'nilaiAkhirMahasiswa' => $nilaiAkhirMahasiswa,
            'kodeMatkul' => $kodeMatkul
        ]);
    }

    
}
