<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmailCollectionModel;
use CodeIgniter\API\ResponseTrait;

class EmailCollection extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        //
    }
    public function insert()
    {

        if (!$this->request->is('post')) {
            $this->fail(405);
            return;
        }

        if (!$this->request->is('json')) {
            $this->fail(400);
            return;
        }
        $data = $this->request->getJson(true);
        $insertData = array(
            "email" => $data["email"]
        );
        $rule = array(
            "email" => "required|valid_email"
        );
        if (!$this->validateData($insertData, $rule)) {
            echo json_encode($this->validator->getErrors());
            $this->fail('Your request is invalid. Please check the request parameters and try again.', 400);
            return;
        }
        $emailCollectionModel = new EmailCollectionModel();
        $insertId = $emailCollectionModel->insert($insertData);

        $returnData = array(
            "status" => $insertId ? true : false,
        );
        echo json_encode($returnData);
        $this->respondCreated($returnData);
    }
}
