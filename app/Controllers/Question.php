<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QuestionModel;
use CodeIgniter\API\ResponseTrait;

class Question extends BaseController
{   
    use ResponseTrait;
    public function insert()
    {
        
        if(!$this->request->is('post')){
            $this->fail(405);
            return;
        }
    
        if(!$this->request->is('json')){
            $this->fail(400);
            return;
        }
        
        $Questionmodel = new QuestionModel();
        $requestData = $this->request->getJson(true);
    
        $data = array(
            "question_nama" => $requestData["question_nama"],
            "question_email" => $requestData["question_email"],
            "question_body" => $requestData["question_body"],
        );
        $rule = [
            "question_nama" => "required",
            "question_email" => "required|valid_email",
            "question_body" => "required",
        ];
        if (!$this->validateData($data, $rule)) {
            echo json_encode($this->validator->getErrors());
            $this->fail('Your request is invalid. Please check the request parameters and try again.',400);
            return;
        }
        
        $res = $Questionmodel->insert($data);
    
        if(!$res){
            $this->fail(400);
            return;
        }
        echo json_encode($data);
        $this->respondCreated($data);
  
    }
}
