<?php

namespace App\Models;

use CodeIgniter\Model;

class Coach extends Model
{
    protected $table            = 'coach';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'team_id', 'image'];
}
