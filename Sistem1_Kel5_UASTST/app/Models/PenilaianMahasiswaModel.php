<?php namespace App\Models;

use CodeIgniter\Model;

class PenilaianDosenModel extends Model
{
    protected $table = 'penilaian_dosen';

    protected $primaryKey = null; // Non-auto-increment table
    protected $returnType = 'array';

    protected $allowedFields = ['nidn_dosen', 'id_penilaian'];
}
