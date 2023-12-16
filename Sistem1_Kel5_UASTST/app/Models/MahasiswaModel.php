<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\CURLRequest;

class MahasiswaModel extends Model
{
    protected $client;

    public function __construct() {
        $this->client = \Config\Services::curlrequest();
    }

    public function getMahasiswa()
    {
        $response = $this->client->request('GET', 'http://alamat_api_anda/api/mahasiswa');
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody(), true);
        }
        
        return [];
    }
}
