<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PenilaianDosenModel;

class PenilaianDosenController extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\PenilaianDosenModel';

    public function index()
    {
        $data = $this->model->getNilai();
        return $this->respond($data);
    }
}
