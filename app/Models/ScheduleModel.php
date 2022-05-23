<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table                    = 'schedule';
    protected $primaryKey               = 'schedule_id';
    protected $allowedFields            = ['drug_id', 'periodicity', 'date_to'];
}