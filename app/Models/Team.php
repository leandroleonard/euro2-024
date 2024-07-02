<?php

namespace App\Models;

use CodeIgniter\Model;

class Team extends Model
{
    protected $table            = 'team';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'description', 'emblem'];
}
