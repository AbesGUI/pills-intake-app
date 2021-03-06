<?php

namespace App\Controllers;

use App\Models\DrugModel;
use App\Models\ScheduleModel;
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
	                    WHERE d.drug_id =' . $db->escape($drug_id))->getResultArray();

        $schedule_model = new ScheduleModel();
        $taken = $db->table('took_drugs')->where('drug_id', $drug_id)->where('date', date('Y-m-d', time()))
            ->get()->getResultArray();
        $took_data = $db->table('took_drugs')->where('drug_id', $drug_id)->get()->getResultArray();

        if (empty($taken)) {
            $show_took_today = true;
        } else {
            $show_took_today = false;
        }

        $date = array_column($took_data, 'date');
        array_multisort($date, SORT_ASC, $took_data);

        $data['data_list'] = esc($data_list[0]);
        $data['show_took_today'] = esc($show_took_today);
        $data['took_data'] = esc($took_data);

        echo view('templates/header');
        echo view('drug', $data);
    }

    public function delete_drug_schedule($id)
    {
        $drug_id = $id;
        $user_id = session()->get('user_id');
        $drug_model = new DrugModel();

        $drug = $drug_model->where('drug_id', $drug_id)->where('user_id', $user_id)->get()->getResultArray();

        if (!empty($drug)) {
            $drug_model->delete($drug_id);

            return redirect()->to('/drugs');
        } else {
            echo view('errors/html/error_403');
        }
    }

    public function set_took_today($id)
    {
        $drug_id = $id;
        $user_id = session()->get('user_id');
        $drug_model = new DrugModel();

        $drug = $drug_model->where('drug_id', $drug_id)->where('user_id', $user_id)->get()->getResultArray();

        if (!empty($drug)) {
            $db = db_connect();
            $db->table('took_drugs')->insert(array('drug_id' => $drug_id));

            return redirect()->to('/drugs');
        } else {
            echo view('errors/html/error_403');
        }
    }

    public function set_untook_today($id)
    {
        $drug_id = $id;
        $user_id = session()->get('user_id');
        $drug_model = new DrugModel();

        $drug = $drug_model->where('drug_id', $drug_id)->where('user_id', $user_id)->get()->getResultArray();

        if (!empty($drug)) {
            $db = db_connect();
            $db->table('took_drugs')->where('drug_id', $drug_id)
                    ->where('date', date('Y-m-d', time()))->delete();

            return redirect()->to('/drugs');
        } else {
            echo view('errors/html/error_403');
        }
    }
}