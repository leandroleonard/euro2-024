<?php

namespace App\Models;

use CodeIgniter\Model;

class Matches extends Model
{
    protected $table            = 'match';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['season_id', 'date', 'home_id', 'away_id', 'goals_home', 'goals_away'];
}
