<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table                = 'oauth_users';
    protected $primaryKey           = 'user_id';
    protected $allowedFields        = ['name', 'facebook_id', 'password', 'email'];
}
