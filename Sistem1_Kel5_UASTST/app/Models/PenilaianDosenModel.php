<?php namespace App\Models;

use CodeIgniter\Model;

class PenilaianDosenModel extends Model
{
    protected $table = 'penilaian_dosen';

    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $allowedFields = ['nim', 'kode', 'nilai_akhir'];
}
