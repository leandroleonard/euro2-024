<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Coach;
use App\Models\Enum\StatusCode;
use CodeIgniter\HTTP\ResponseInterface;

class CoachController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Coach;
    }

    public function index()
    {
        return view('coach/index');
    }

    public function form(string $id = null)
    {
        $data = null;

        if ($id) {
            $data = $this->model->select('
                    coach.id,
                    coach.name,
                    coach.image,
                    coach.team_id,
                    team.name as team
                ')->join('team', 'team.id=coach.team_id')->first();
        }

        return view('coach/form', ['data' => $data]);
    }

    public function get(string $id = null)
    {
        if ($id) {
            $data = $this->model->select('
                coach.id,
                coach.name,
                coach.image,
                coach.team_id,
                team.name as team
            ')->join('team', 'team.id=coach.team_id')->first();

            $response = [
                'status'    => $data ? StatusCode::OK->value : StatusCode::NOT_FOUND->value,
                'message'   => "Fetch data",
                'data'      => []
            ];

            return $this->response($response);
        }

        $data = $this->model->select('
                coach.id,
                coach.name,
                coach.image,
                coach.team_id,
                team.name as team
            ')->join('team', 'team.id=coach.team_id')->findAll();

        $response = [
            'status'    => $data != 0 ? StatusCode::OK->value : StatusCode::NOT_FOUND->value,
            'message'   => "Fetch data",
            'data'      => $data
        ];

        return $this->response($response);
    }

    public function submit($id = null)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name'      => 'required',
            'team_id'   => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status'    => StatusCode::BAD_REQUEST->value,
                'message'   => $validation->getErrors(),
            ];

            return $this->response($response);
        }

        $image      = $this->request->getFile('image');
        $imageName  = null;

        if ($image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/coaches', $imageName);
        }

        $data           = $this->request->getPost();
        $data['image']  = $imageName ?? $data['image_name'] ?? null;

        if (!$this->model->save($data)) {
            $response = [
                'status'    => StatusCode::SERVER_ERROR->value,
                'message'   => $this->model->errors()
            ];

            return $this->response($response);
        }


        return $this->response([
            'status'    => StatusCode::CREATED->value,
            'message'   => 'Saved!',
            'data'      => ['image' => $imageName]
        ]);
    }

    public function delete($id = null)
    {
        if ($id && $this->model->where('id', $id)->find()) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => StatusCode::NO_CONTENT->value,
                    'message' => 'Coach was deleted',
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
