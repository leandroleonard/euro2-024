<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamsGroup extends Model
{
    protected $table            = 'teams_group';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['group_id', 'team_id'];
}
