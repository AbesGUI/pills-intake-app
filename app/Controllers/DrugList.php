<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DrugList extends Controller
{
    public function index()
    {
        $db = db_connect();

        $sql = 'SELECT d.user_id, d.drug_id, d.name AS drug_name, d.description,
                                c.category_id, c.name AS category, s.periodicity, s.date_to, s.took_today,
                                td.took_id
                        FROM drugs d
                            JOIN schedule s USING (drug_id)
	                        JOIN categories c 
	                            ON d.drug_category_id = c.category_id
                            LEFT JOIN (
                                SELECT took_id, drug_id
                                FROM took_drugs
                                WHERE date LIKE '.$db->escape(date('Y-m-d', time())).'
                            ) td ON td.drug_id = d.drug_id
	                    WHERE d.user_id =' . $db->escape(session()->get('user_id'));


        $drug_category = $this->request->getVar('drug_category');

        if(!empty($drug_category)) {
            $sql.= ' AND category_id = '.$db->escape($drug_category);
        }

        $data_list = $db->query($sql)->getResultArray();

        $data['drug_list'] = esc($data_list);
        $data['category_list'] = $db->query("SELECT * FROM categories")->getResultArray();
        $data['get_id'] = $this->request->getVar('drug_category');

        echo view('templates/header');
        echo view('listofdrugs', $data);
    }
}