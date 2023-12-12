<?php namespace App\Models;

use CodeIgniter\Model;

class MataKuliahModel extends Model
{
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['kode', 'nama', 'sks'];

    // Fungsi untuk mengambil semua mata kuliah
    public function getMataKuliah()
    {
        return $this->findAll();
    }
}