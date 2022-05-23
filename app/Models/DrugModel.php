<?php

namespace App\Models;

use CodeIgniter\Model;

class DrugModel extends Model
{
    protected $table                    = 'drugs';
    protected $primaryKey               = 'drug_id';
    protected $allowedFields            = ['name', 'user_id', 'description', 'drug_category_id'];
}
