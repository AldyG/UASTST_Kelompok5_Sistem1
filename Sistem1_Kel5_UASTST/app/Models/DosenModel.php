<?php namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'nidn'; 
    
    protected $useAutoIncrement = false; // Diubah jika NIDN tidak auto-increment
    protected $returnType = 'array';

    protected $allowedFields = ['nidn', 'nama', 'fakultas', 'password'];

    // Fungsi untuk autentikasi dosen
    public function validateDosen($nidn, $password)
    {
        $dosen = $this->where('nidn', $nidn)->first();
        
        if ($dosen && password_verify($password, $dosen['password'])) {
            return $dosen;
        }

        return null;
    }
}
