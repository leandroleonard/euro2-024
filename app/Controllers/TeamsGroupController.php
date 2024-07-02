<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Enum\StatusCode;
use App\Models\Group;
use App\Models\Team;
use App\Models\TeamsGroup;
use CodeIgniter\HTTP\ResponseInterface;

class TeamsGroupController extends BaseController
{
    protected $model;
    protected $modelTeam;
    protected $modelGroup;

    public function __construct()
    {
        $this->model        = new TeamsGroup;
        $this->modelTeam    = new Team;
        $this->modelGroup   = new Group;
    }

    public function index()
    {
        return view('group/index');
    }

    // public function get($id = null)
    // {
    //     $teams = $this->model->groupBy('group_id')->get();

    //     dd($teams);
    //     exit;
    // }

    public function get($id = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('teams_group tg');

        $builder->select('g.description AS Group, GROUP_CONCAT(t.name ORDER BY t.name ASC SEPARATOR ", ") AS teams, GROUP_CONCAT(t.emblem ORDER BY t.name ASC SEPARATOR ", ") AS images');

        $builder->join('group g', 'tg.group_id = g.id');
        $builder->join('team t', 'tg.team_id = t.id');
        $builder->groupBy('tg.group_id, g.description');

        $query = $builder->get();

        $teams = $query->getResult();

        foreach ($teams as $team) {
            $team->teams = explode(", ", $team->teams);
            $team->images = explode(", ", $team->images);

            $data[] = $team;
            
        }

        $response = [
            'status' => StatusCode::OK->value,
            'message' => 'Fetch data',
            'data' => $teams
        ];
        return $this->response($response);
    }


    public function sort()
    {
        $teamGroup = $this->model->findAll();

        $groups = $this->modelGroup->select('id')->findAll();

        $teams = $this->modelTeam->select('id')->findAll();

        shuffle($teams);


        $team_index = 0;

        $count = 4;

        if (count($teamGroup) == 0) {
            foreach ($groups as $group) {

                while ($team_index < $count) {
                    $data = [
                        'group_id'  => $group['id'],
                        'team_id'   => $teams[$team_index]['id'],
                    ];

                    $team_index++;
                    $this->model->save($data);
                }
                $count += 4;
            }
        }
    }
}
