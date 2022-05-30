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
            'drug_name'             => 'required|min_length[3]|max_length[20]',
            'drug_category'         => 'required',
            'schedule_time'         => 'required',
            'drug_description'      => 'max_length[50]'
        ];

        if ($this->validate($rules)) {
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
        } else {
            $data['validation'] = $this->validator;
            echo view('templates/header');
            echo view('create_edit_schedule', $data);
        }
    }

    public function update_drug($id)
    {
        $db = db_connect();
        helper(['form']);
        $drug_id = $id;
        $data['category_list'] = $db->query("SELECT * FROM categories")->getResultArray();

        $data_list = $db->query('SELECT d.user_id, d.drug_id, d.name AS drug_name, d.description,
                                c.name AS category, c.category_id, s.periodicity, s.date_to
                        FROM drugs d
                            JOIN schedule s USING (drug_id)
	                        JOIN categories c 
	                            ON d.drug_category_id = c.category_id
	                    WHERE d.drug_id =' . $db->escape($drug_id))->getResultArray();

        $data['data_list'] = $data_list[0];
        echo view('templates/header');
        echo view('edit_schedule', $data);
        echo view('templates/footer');
    }

    public function save_update_drug($id)
    {
        helper(['form']);
        $db = db_connect();
        $drug_data = new DrugModel();
        $data['drug_id'] = $id;
        $data['category_id'] = $drug_data->where('drug_id', $id)->get()->getResultArray()[0]['drug_category_id'];
        $data['category_list'] = $db->query("SELECT * FROM categories")->getResultArray();
        $rules = [
            'drug_name'             => 'required|min_length[3]|max_length[20]',
            'drug_category'         => 'required',
            'schedule_time'         => 'required',
            'drug_description'      => 'max_length[50]'
        ];

        if ($this->validate($rules)) {
            $drugModel = new DrugModel();
            $scheduleModel = new ScheduleModel();
            $drugData = [
                'name'              => $this->request->getVar('drug_name'),
                'user_id'           => session()->get('user_id'),
                'description'       => $this->request->getVar('drug_description'),
                'drug_category_id'  => $this->request->getVar('drug_category')
            ];
            $drugModel->update($id, $drugData);

            $scheduleData = [
                'periodicity'       => $this->request->getVar('schedule_time'),
                'date_to'           => $this->request->getVar('schedule_to')
            ];
            $schedule_id = $scheduleModel->where('drug_id', $id)->get()->getResultArray()[0]['schedule_id'];
            $scheduleModel->update($schedule_id, $scheduleData);

            return redirect()->to('/drugs');
        } else {

            $data['validation'] = $this->validator;
            echo view('templates/header');
            echo view('edit_schedule', $data);
            echo view('templates/footer');
        }
    }
}