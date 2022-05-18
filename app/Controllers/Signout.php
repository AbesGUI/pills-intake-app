<?php
namespace App\Controllers;
use App\Libraries\OAuth;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\UserModel;
use OAuth2\Request;

class Signout extends Controller
{
    use ResponseTrait;

    public function index()
    {
        helper(['form']);
        session()->destroy();
        return redirect()->to('/signin');
    }
}