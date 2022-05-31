<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Libraries\FacebookCall;


class Signin extends Controller
{
    use ResponseTrait;

    public function index()
    {
        helper(['form']);

        if (session()->get('isLoggedIn')) {
            return redirect()->to('/drugs');
        } else {
            echo view('signin');
        }
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $userModel->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'user_id'           => $data['user_id'],
                    'name'              => $data['name'],
                    'email'             => $data['email'],
                    'isLoggedIn'        => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/drugs');
            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/signin');
            }
        } else {
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/signin');
        }
    }

    public function facebookLogin()
    {
        $session = session();

        $fb_c = new FacebookCall();
        $fb_data = $fb_c->getFbUserData();

        $checkUserExistence = new UserModel();
        $userData = $checkUserExistence->where('email', $fb_data['email'])->first();

        if (is_null($userData)) {
            $userModel = new UserModel();
            $data = [
                'facebook_id'           => $fb_data['facebook_id'],
                'name'                  => $fb_data['name'],
                'email'                 => $fb_data['email']
            ];
            $userModel->insert($data);
            $userData = $checkUserExistence->where('email', $fb_data['email'])->first();
        }
        $ses_data = [
            'user_id'               => $userData['user_id'],
            'name'                  => $userData['name'],
            'email'                 => $userData['email'],
            'isLoggedIn'            => TRUE
        ];
        $session->set($ses_data);

        return redirect()->to('/drugs');
    }
}