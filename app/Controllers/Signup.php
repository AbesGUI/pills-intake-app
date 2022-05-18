<?php
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\UserModel;

class Signup extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        helper(['form']);

        if (session()->get('isLoggedIn')){
            return redirect()->to('/drugs');
        } else {
            echo view('signup');
            echo view('templates/footer.php');
        }
    }

    public function store()
    {
        $session = session();
        helper(['form']);
        $rules = [
            'name'              => 'required|min_length[3]|max_length[20]',
            'email'             => 'required|valid_email|is_unique[oauth_users.email]',
            'password'          => 'required|min_length[8]|max_length[36]',
            'password_confirm'  => 'matches[password]'
        ];

        if($this->validate($rules)){
            $userModel = new UserModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];

            $userModel->insert($data);

            $user_data = $userModel->where('email', $this->request->getVar('email'))->first();

            $ses_data = [
                'user_id' => $user_data['user_id'],
                'name' => $user_data['name'],
                'email' => $user_data['email'],
                'isLoggedIn' => TRUE
            ];

            $session->set($ses_data);
            return redirect()->to('/profile');
        }else{
            $data['validation'] = $this->validator;
            echo view('signup', $data);
        }

    }

}