<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Enum\StatusCode;
use App\Models\Player;
use CodeIgniter\HTTP\ResponseInterface;

class PlayerController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Player;
    }

    public function index()
    {
        return view('player/index');
    }

    public function form($id = null)
    {
        $data = null;

        if ($id) {
            $data = $this->model->select('
                    player.id,
                    player.name,
                    player.position,
                    player.image,
                    player.birthday,
                    player.team_id,
                    team.name as team
                ')->join('team', 'team.id=player.team_id')->first();
        }

        return view('player/form', ['data' => $data]);
    }

    public function get(string $id = null)
    {
        if ($id) {
            $response = [
                'status' => StatusCode::OK->value,
                'message' => 'Fetch data',
                'data' => $this->model->select('
                    player.id,
                    player.name,
                    player.position,
                    player.image,
                    player.birthday,
                    player.team_id,
                    team.name as team
                ')->join('team', 'team.id=player.team_id')->first(),
            ];

            return $this->response($response);
        }



        $response = [
            'status' => StatusCode::OK->value,
            'message' => 'Fetch data',
            'data' => $this->model->select('
                player.id,
                player.name,
                player.position,
                player.image,
                player.birthday,
                player.team_id,
                team.name as team
            ')->join('team', 'team.id=player.team_id')->findAll(),
        ];

        return $this->response($response);
    }

    public function submit($id = null)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name'  => 'required',
            'position' => 'required',
            'birthday' => 'required',
            'team_id' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => StatusCode::BAD_REQUEST->value,
                'message' => $validation->getErrors(),
            ];

            return $this->response($response);
        }


        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/players', $imageName);
        }

        $data = $this->request->getPost();
        $data['image'] = $imageName ?? $data['image_name'] ?? null;


        if (!$this->model->save($data)) {
            $response = [
                'status' => StatusCode::SERVER_ERROR->value,
                'message' => $this->model->errors(),
            ];

            return $this->response($response);
        }

        $response = [
            'status' => StatusCode::CREATED->value,
            'message' => 'Saved!',
            'data' => [
                'image' => $imageName
            ]
        ];

        return $this->response($response);
    }

    public function delete($id = null)
    {
        if ($id && $this->model->where('id', $id)->find()) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => StatusCode::NO_CONTENT->value,
                    'message' => 'Player was deleted',
                ];

                return $this->response($response);
            }

            $response = [
                'status' => StatusCode::SERVER_ERROR->value,
                'message' => $this->model->errors(),
            ];

            return $this->response($response);
        }

        $response = [
            'status' => StatusCode::BAD_REQUEST->value,
            'message' => 'You need to specif a valid id',
        ];

        return $this->response($response);
    }
}
