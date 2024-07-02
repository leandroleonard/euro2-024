<?php

namespace App\Controllers;

use App\Models\Enum\StatusCode;
use App\Models\Team;
use CodeIgniter\Controller;

class TeamController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Team;
    }

    public function index()
    {
        return view('team/index');
    }

    public function submit($id = null)
    {
        $data = null;

        if ($id) {
            $data = $this->model->where('id', $id)->first();
        }

        return view('team/form', ['data' => $data]);
    }

    public function get(string $id = null)
    {
        if ($id)
            return $this->response->setStatusCode(200)->setJSON($id);


        $response = [
            'status' => StatusCode::OK->value,
            'message' => 'Fetch data',
            'data' => $this->model->findAll(),
        ];

        return $this->response($response);
    }

    public function save(string $id = null)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name'  => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => StatusCode::BAD_REQUEST->value,
                'message' => $validation->getErrors(),
            ];

            return $this->response->setStatusCode($response['status'])->setJSON($response);
        }

        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/emblem', $imageName);
        }

        $data = $this->request->getPost();
        $data['emblem'] = $imageName ?? $data['image_name'] ?? null;

        $model = new Team;

        if (!$model->save($data)) {
            $response = [
                'status' => StatusCode::SERVER_ERROR->value,
                'message' => $model->errors(),
            ];

            return $this->response->setStatusCode($response['status'])->setJSON($response);
        }

        $response = [
            'status' => StatusCode::CREATED->value,
            'message' => 'Saved',
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
                    'message' => 'Team was deleted',
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
