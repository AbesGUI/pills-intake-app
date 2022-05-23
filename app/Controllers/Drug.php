<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Drug extends Controller
{
    public function index($id)
    {
        $drug_id = $id;
        $db = db_connect();
        $data_list = $db->query('SELECT d.user_id, d.drug_id, d.name AS drug_name,
                                c.name AS category, s.periodicity, s.date_to
                        FROM drugs d
                            JOIN schedule s USING (drug_id)
	                        JOIN categories c 
	                            ON d.drug_category_id = c.category_id
	                    WHERE d.drug_id =' .$db->escape($drug_id))->getResultArray();


        $data['data_list'] = $data_list;

        echo view('templates/header');
        echo '<h1>'.$data_list[0]['drug_id'].'</h1>';
        echo view('templates/footer');
    }
}