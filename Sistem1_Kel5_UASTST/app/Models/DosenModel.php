<?php namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'NIDN'; 
    
    protected $useAutoIncrement = false; // Diubah jika NIDN tidak auto-increment
    protected $returnType = 'array';

    protected $allowedFields = ['NIDN', 'nama', 'email', 'password'];

    // Fungsi untuk autentikasi dosen
    public function authenticate($NIDN, $password)
    {
        $dosen = $this->where('NIDN', $NIDN)->first();
        if ($dosen && password_verify($password, $dosen['password'])) {
            return $dosen;
        }
        return false;
    }
}
