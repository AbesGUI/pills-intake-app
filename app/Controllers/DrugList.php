<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DrugList extends Controller
{
    public function index()
    {
        $db = db_connect();

        $data_list = $db->query('SELECT d.user_id, d.drug_id, d.name AS drug_name, d.description,
                                c.name AS category, s.periodicity, s.date_to, s.took_today
                        FROM drugs d
                            JOIN schedule s USING (drug_id)
	                        JOIN categories c 
	                            ON d.drug_category_id = c.category_id
	                    WHERE d.user_id =' . $db->escape(session()->get('user_id')))->getResultArray();


        $data['drug_list'] = $data_list;

        echo view('templates/header');
        echo view('listofdrugs', $data);
        echo view('templates/footer');
    }
}