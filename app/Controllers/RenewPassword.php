<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use PHPMailer\PHPMailer\PHPMailer;

class RenewPassword extends Controller
{
    public function index()
    {
        echo view('templates/header');
        echo view('send_code');
    }

    public function send_code()
    {
        helper(['form']);
        $rules = [
            'email'     => 'required|valid_email',
        ];

        $db = db_connect();
        $user_email = $this->request->getVar('email');
        $user_model = new UserModel();
        $user_data = $user_model->where('email', $user_email)->first();
        $data['user_data'] = $user_data;

        if ($this->validate($rules) && !empty($user_data)) {
            $company_email = 'pills_intake@vse.cz';
            $code = rand(100000, 993952);

            $forgotten_password = array(
                'user_id'       => $user_data['user_id'],
                'code'          => $code
            );

            $db->table('forgotten_passwords')->insert($forgotten_password);

            $mailer = new PHPMailer(false);
            $mailer->isSendmail();

            $mailer->addAddress($user_email);
            $mailer->setFrom($company_email);

            $mailer->CharSet = 'utf-8';
            $mailer->Subject = 'Password renewal on "pills-intake"';
            $mailer->isHTML(true);
            $mailer->Body = '<html><head><meta charset="utf-8" /></head><body>Your code to renew password in Pills Intake app is ' . $code . ' </body></html>';

            $mailer->send();

            echo view('templates/header');
            echo view('renew_password');
        } else {
            $data['validation'] = 'Email not found in our database';
            echo view('templates/header');
            echo view('send_code', $data);
        }
    }

    public function renewal()
    {
        echo view('templates/header');
        echo view('send_code');
    }

    public function renew()
    {
        helper(['form']);
        $rules = [
            'code'                      => 'required',
            'password'                  => 'required|min_length[8]|max_length[36]',
            'password_confirmation'     => 'matches[password]'
        ];

        $db = db_connect();
        $user_id = $db->table('forgotten_passwords')->where('code', $this->request->getVar('code'))->get()->getResultArray();
        $has_code = !empty($user_id);
        $valid = $this->validate($rules);
        $expired = strtotime($user_id[0]['created']) < (time() - 2 * 3600);

        if ($valid && $has_code && !$expired) {
            $user_model = new UserModel();
            $user = $user_model->where('user_id', $user_id[0]['user_id'])->first();
            $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            $user['password'] = $password;

            $user_model->update($user_id[0]['user_id'], $user);
            $db->table('forgotten_passwords')->delete(array('user_id' => $user_id[0]['user_id']));

            $session = session();
            $ses_data = [
                'user_id'           => $user['user_id'],
                'name'              => $user['name'],
                'email'             => $user['email'],
                'isLoggedIn'        => TRUE
            ];
            $session->set($ses_data);

            return redirect()->to('/drugs');
        }
        if (!$has_code) $data['no_code'] = 'Code is wrong, try another one, please';
        if (!$valid) $data['validation'] = $this->validator;
        if ($expired) $data['expired'] = 'Code expired, please request another one';

        echo view('templates/header');
        echo view('renew_password', $data);
    }

    public function set_password()
    {
        helper(['form']);
        $rules = [
            'password'              => 'required|min_length[8]|max_length[36]',
            'password_confirmation' => 'matches[password]'
        ];
        $valid = $this->validate($rules);

        if ($valid) {
            $user_model = new UserModel();
            $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            $user_id = session()->get('user_id');

            $user_model->update($user_id, array('password' => $password));

            return redirect()->to('/drugs');
        } else {
            $data['validation'] = $this->validator;
            echo view('templates/header');
            echo view('set_password', $data);
        }
    }

    public function show_set_password()
    {
        echo view('templates/header');
        echo view('set_password');
    }
}