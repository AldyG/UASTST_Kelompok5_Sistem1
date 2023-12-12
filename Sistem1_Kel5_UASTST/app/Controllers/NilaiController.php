<?php namespace App\Controllers;

use App\Models\NilaiModel;
use CodeIgniter\Controller;

class NilaiController extends Controller
{
    public function dashboard()
    {
        // Pastikan dosen sudah login
        if(!session()->get('isLoggedIn')){
            return redirect()->to('/');
        }

        // Tampilkan dashboard
        return view('dashboard');
    }

    public function input()
    {
        // Tampilkan halaman input nilai
        // Pastikan untuk menambahkan validasi akses
        return view('input_nilai');
    }

    public function simpan()
    {
        // Proses simpan nilai
        $model = new NilaiModel();
        $data = [
            'mahasiswa_id' => $this->request->getVar('mahasiswa_id'),
            'mata_kuliah_id' => $this->request->getVar('mata_kuliah_id'),
            'nilai' => $this->request->getVar('nilai'),
            'kategori_nilai' => $this->request->getVar('kategori_nilai')
        ];

        $model->simpanNilai($data);
        return redirect()->to('/dashboard');
    }

    public function lihat()
    {
        // Tampilkan halaman lihat nilai
        // Pastikan untuk menambahkan validasi akses
        return view('lihat_nilai');
    }

    public function hitungNilaiAkhir($mahasiswaId)
    {
        $model = new NilaiModel();

        // Mengambil nilai tugas
        $nilaiTugas = $model->getNilaiByKategori($mahasiswaId, 'tugas');

        // Menghitung rata-rata nilai tugas
        $totalNilaiTugas = 0;
        foreach ($nilaiTugas as $nilai) {
            $totalNilaiTugas += $nilai['nilai'];
        }
        $rataRataTugas = count($nilaiTugas) > 0 ? $totalNilaiTugas / count($nilaiTugas) : 0;

        // Mengambil nilai UTS dan UAS
        $nilaiUTS = $model->getNilaiByKategori($mahasiswaId, 'uts')[0]['nilai'] ?? 0;
        $nilaiUAS = $model->getNilaiByKategori($mahasiswaId, 'uas')[0]['nilai'] ?? 0;

        // Menghitung nilai akhir
        $nilaiAkhir = (0.2 * $rataRataTugas) + (0.4 * $nilaiUTS) + (0.4 * $nilaiUAS);

        // Konversi nilai akhir ke indeks nilai
        $indeksNilai = $this->konversiNilaiKeIndeks($nilaiAkhir);

        // Update nilai akhir dan indeks nilai di database
        // ... (kode untuk update database)

        return $indeksNilai;
    }
}
