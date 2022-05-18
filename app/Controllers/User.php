<?php

namespace App\Controllers;

use \App\Libraries\OAuth;
use App\Models\UserModel;
use \OAuth2\Request;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;

    public function login() {
        $oauth = new OAuth();
        $request = new Request();
        $respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
        $code = $respond->getStatusCode();
        $body = $respond->getResponseBody();

        return $this->respond(json_decode($body), $code);
    }

    public function register() {
        helper('form');
        $data = [];

        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->fail('Only POST requests is allowed.');
        }

        $rules = [
            'first_name' => 'required|min_length[3]|max_length[20]',
            'last_name' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|valid_email|is_unique[oauth_users.email]',
            'password' => 'required|min_length[8]|max_length[36]',
            'password_confirm' => 'matches[password]'
        ];

        if(!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $model = new UserModel();

            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password')
            ];

            $user_id = $model->insert($data);
            $data['user_id'] = $user_id;
            unset($data['password']);

            return $this->respondCreated($data);
        }
    }

}