<?php namespace App\Controllers;

use App\Models\NilaiModel;
use CodeIgniter\Controller;

use App\Models\DosenModel;
use App\Models\MataKuliahModel;
use App\Models\MatkulDosenModel;
use App\Models\MatkulMahasiswaModel;
use App\Models\PenilaianDosenModel;

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
        // Pastikan dosen sudah login
        if(!session()->get('logged_in_dosen')){
            return redirect()->to('/');
        }

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
        // Pastikan dosen sudah login
        if(!session()->get('logged_in_dosen')){
            return redirect()->to('/');
        }

        $penilaianModel = new NilaiModel();
        $jenis = $this->request->getPost('kategori_nilai');
        $nim = $this->request->getPost('mahasiswa_id');
        $kodeMatkul = $this->request->getPost('kode_matkul');

        // Pengecekan untuk uts atau uas
        if ($jenis == 'uts' || $jenis == 'uas') {
            // Cari nilai yang ada
            $existingNilai = $penilaianModel->where('nim_mahasiswa', $nim)
                                        ->where('kode_matkul', $kodeMatkul)
                                        ->where('jenis', $jenis)
                                        ->first();
        
            if ($existingNilai) {
                // Jika nilai sudah ada, update nilai tersebut
                $data = [
                'id' => $existingNilai['id'], // Asumsi 'id' adalah primary key
                'nilai' => $this->request->getPost('nilai'),
                // Pertahankan nilai lainnya
                'jenis' => $jenis,
                'deskripsi' => $this->request->getPost('deskripsi'),
                'nim_mahasiswa' => $nim,
                'kode_matkul' => $kodeMatkul
            ];
        } else {
            // Jika belum ada, tambahkan sebagai data baru
            $data = [
                'jenis' => $this->request->getPost('kategori_nilai'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'nilai' => $this->request->getPost('nilai'),
                'nim_mahasiswa' => $this->request->getPost('mahasiswa_id'),
                'kode_matkul' => $this->request->getPost('kode_matkul')
            ];
        }
        } else {
        // Untuk jenis tugas, selalu tambah data baru
        $data = [
            'jenis' => $this->request->getPost('kategori_nilai'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'nilai' => $this->request->getPost('nilai'),
            'nim_mahasiswa' => $this->request->getPost('mahasiswa_id'),
            'kode_matkul' => $this->request->getPost('kode_matkul')
        ];
        }


        $penilaianModel->save($data);

        // Redirect atau tampilkan pemberitahuan setelah menyimpan
        return redirect()->to('/dashboard'); 
    }

    public function lihatNilai($kodeMatkul)
    {
        // Pastikan dosen sudah login
        if(!session()->get('logged_in_dosen')){
            return redirect()->to('/');
        }

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

    public function finalisasiNilai($kodeMatkul)
  {
    // Pastikan dosen sudah login
    if(!session()->get('logged_in_dosen')){
        return redirect()->to('/');
    }

    $penilaianModel = new NilaiModel();
    $penilaianDosenModel = new PenilaianDosenModel();

    // Ambil semua nilai untuk mata kuliah yang diberikan
    $nilaiMahasiswa = $penilaianModel->where('kode_matkul', $kodeMatkul)->findAll();
    $nilaiAkhirMahasiswa = []; // Menyimpan nilai akhir untuk cek duplikasi

    foreach ($nilaiMahasiswa as $nilai) {
        $nim = $nilai['nim_mahasiswa'];
        if (!isset($nilaiAkhirMahasiswa[$nim])) {
            $nilaiMahasiswaPerNIM = $penilaianModel->where('kode_matkul', $kodeMatkul)
                                                   ->where('nim_mahasiswa', $nim)
                                                   ->findAll();
            $nilaiAkhir = $this->hitungNilaiAkhir($nilaiMahasiswaPerNIM);
            $nilaiAkhirMahasiswa[$nim] = $nilaiAkhir; // Simpan nilai akhir untuk cek duplikasi

            $existingNilai = $penilaianDosenModel->where('kode', $kodeMatkul)
                                                 ->where('nim', $nim)
                                                 ->first();
            $data = [
                'nim' => $nim,
                'kode' => $kodeMatkul,
                'nilai_akhir' => $nilaiAkhir
            ];

            if ($existingNilai) {
                // Jika data sudah ada, update nilai akhir
                $data['id'] = $existingNilai['id'];
            }

            $penilaianDosenModel->save($data);
        }
    }

    return redirect()->to('/dashboard');
  }

}
