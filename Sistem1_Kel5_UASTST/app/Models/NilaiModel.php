<?php namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{

    //Send request buat ambil nim mmahasiswa yang ada di kelas.
    
    protected $table = 'penilaian';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['jenis', 'deskripsi', 'nilai', 'nim_mahasiswa', 'kode_matkul'];

    // Fungsi untuk menyimpan nilai mahasiswa
    public function simpanNilai($data)
    {
        return $this->save($data);
    }

    // Fungsi untuk mengambil nilai mahasiswa
    public function getNilaiByMahasiswa($mahasiswaId)
    {
        return $this->where('mahasiswa_id', $mahasiswaId)->findAll();
    }

    // Fungsi untuk mengambil nilai berdasarkan kategori
    public function getNilaiByKategori($mahasiswaId, $kategori)
    {
        return $this->where('mahasiswa_id', $mahasiswaId)
                    ->where('kategori_nilai', $kategori)
                    ->findAll();
    }
}
