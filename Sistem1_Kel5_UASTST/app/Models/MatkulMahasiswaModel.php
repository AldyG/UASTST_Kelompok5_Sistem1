<?php namespace App\Models;

use CodeIgniter\Model;

class MatkulMahasiswaModel extends Model
{
    protected $table = 'matkul_mahasiswa';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['nim_mahasiswa', 'kode_matkul'];
}
