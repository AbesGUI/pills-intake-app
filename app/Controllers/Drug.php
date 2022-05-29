<?php

namespace App\Controllers;

use App\Models\DrugModel;
use CodeIgniter\Controller;

class Drug extends Controller
{
    public function index($id)
    {
        $drug_id = $id;
        $db = db_connect();
        $data_list = $db->query('SELECT d.user_id, d.drug_id, d.name AS drug_name, d.description,
                                c.name AS category, s.periodicity, s.date_to
                        FROM drugs d
                            JOIN schedule s USING (drug_id)
	                        JOIN categories c 
	                            ON d.drug_category_id = c.category_id
	                    WHERE d.drug_id =' .$db->escape($drug_id))->getResultArray();


        $data['data_list'] = $data_list[0];

        echo view('templates/header');
        echo view('drug', $data);
        echo view('templates/footer');
    }

    public function delete_drug_schedule($id)
    {
        $drug_id = $id;
        $user_id = session()->get('user_id');
        $drug_model = new DrugModel();

        $drug = $drug_model->where('drug_id', $drug_id)->where('user_id', $user_id)->get()->getResultArray();

        if (!empty($drug)){
            $drug_model->delete($drug_id);

            return redirect()->to('/drugs');
        } else {
            echo view('errors/html/error_403');
        }
    }
}