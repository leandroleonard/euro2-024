<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Matches;
use App\Models\TeamsGroup;
use CodeIgniter\HTTP\ResponseInterface;

class MatchController extends BaseController
{
    protected $model;
    protected $teamsGroup;

    public function __construct()
    {
        $this->model        = new Matches;
        $this->teamsGroup   = new TeamsGroup;
    }

    public function index()
    {
        
    }

    public function sortMatchGroups()
    {
        $teamsGroup = $this->teamsGroup->join('team', 'team.id=teams_group.team_id')
                ->join('group', 'group.id=teams_group.group_id')
                ->select('group.id as groupId, team.id as teamId')
                ->findAll();

        dd($teamsGroup);

    }
}
