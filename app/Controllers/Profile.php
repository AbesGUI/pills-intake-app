<?php
namespace App\Controllers;
use App\Models\DrugModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Profile extends Controller
{
    public function index()
    {
        $drugs = new DrugModel();
        $user_model = new UserModel();
        $drugs_count = $drugs->where('user_id', session()->get('user_id'))
                                ->selectCount('drug_id')->get()->getResultArray();
        $data['drugs_count'] = $drugs_count;

        $user_data = $user_model->where('user_id', session()->get('user_id'))->get()->getResultArray();

        if(!empty($user_data) && $user_data[0]['password'] == '') {
            $data['show_set_password'] = true;
        } else {
            $data['show_set_password'] = false;
        }

        echo view('templates/header');
        echo view('profile', $data);
        echo view('templates/footer');
    }
}