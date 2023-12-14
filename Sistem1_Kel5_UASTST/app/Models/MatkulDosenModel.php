<?php namespace App\Models;

use CodeIgniter\Model;

class MatkulDosenModel extends Model
{
    protected $table = 'matkul_dosen';

    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $allowedFields = ['nidn_dosen', 'kode_matkul'];
}
