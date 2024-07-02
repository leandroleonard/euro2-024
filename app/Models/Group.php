<?php

namespace App\Models;

use CodeIgniter\Model;

class Group extends Model
{
    protected $table            = 'group';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['description'];
}
