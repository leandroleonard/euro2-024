<?php

namespace App\Models;

use CodeIgniter\Model;

class Player extends Model
{
    protected $table            = 'player';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'position', 'birthday', 'image', 'team_id'];
}
