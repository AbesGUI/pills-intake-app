<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\DrugModel;

class DrugList extends Controller
{
    public function index()
    {

        $drugModel = new DrugModel();

        $drugList = $drugModel->findAll();

        $data['drug_list'] = $drugList;

        echo view('templates/header');
        echo view('listofdrugs', $data);
        echo view('templates/footer');
    }
}