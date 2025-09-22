<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table            = 'activity_log';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['type', 'description', 'created_at', 'created_by'];
    protected $useTimestamps    = false; // karena kita pakai created_at manual
}
