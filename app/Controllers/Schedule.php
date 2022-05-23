<?php
namespace App\Controllers;
use App\Models\DrugModel;
use App\Models\ScheduleModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Schedule extends Controller
{
    public function index()
    {
        $db = db_connect();
        $data['category_list'] = $db->query("SELECT * FROM categories")->getResultArray();

        echo view('templates/header');
        echo view('create_edit_schedule', $data);
    }

    public function store()
    {
        $db = db_connect();
        $data['category_list'] = $db->query("SELECT * FROM categories")->getResultArray();
        helper(['form']);

        $rules = [
            'drug_name'              => 'required|min_length[3]|max_length[20]|is_unique[drugs.name]'
        ];

        if($this->validate($rules)){
            $drugModel = new DrugModel();
            $scheduleModel = new ScheduleModel();
            $drugData = [
                'name' => $this->request->getVar('drug_name'),
                'user_id' => session()->get('user_id'),
                'description' => $this->request->getVar('drug_description'),
                'drug_category_id' => $this->request->getVar('drug_category')
            ];

            $drug_id = $drugModel->insert($drugData);

            $scheduleData = [
                'drug_id' => $drug_id,
                'periodicity' => $this->request->getVar('schedule_time'),
                'date_to' => $this->request->getVar('schedule_to')
            ];

            $scheduleModel->insert($scheduleData);

            return redirect()->to('/drugs');
        }else{
            $data['validation'] = $this->validator;

            echo view('templates/header');
            echo view('create_edit_schedule', $data);
        }


    }
}