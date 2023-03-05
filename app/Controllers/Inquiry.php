<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\InquiryModel;
use CodeIgniter\API\ResponseTrait;

class Inquiry extends BaseController

{
    use ResponseTrait;
    public function insert(){

        if(!$this->request->is('post')){
          $this->fail(405);
          return;
        }
    
        if(!$this->request->is('json')){
          $this->fail(400);
          return;
        }
        
        $InquiryModel = new InquiryModel();
        $requestData = $this->request->getJson(true);
    
        $data = array(
          "inquiry_nama" => $requestData["inquiry_nama"],
          "inquiry_email" => $requestData["inquiry_email"],
          "inquiry_perusahaan" => $requestData["inquiry_perusahaan"],
          "inquiry_subject" => $requestData["inquiry_subject"],
          "inquiry_message" => $requestData["inquiry_message"],
        );
        $rule = [
          "inquiry_nama" => "required",
          "inquiry_email" => "required|valid_email",
          "inquiry_perusahaan" => "required",
          "inquiry_subject" => "required",
          "inquiry_message" => "required",
        ];
        if (!$this->validateData($data, $rule)) {
          echo json_encode($this->validator->getErrors());
          $this->fail('Your request is invalid. Please check the request parameters and try again.',400);
          return;
        }
        
        $res = $InquiryModel->insert($data);
    
        if(!$res){
          $this->fail(400);
          return;
        }
        echo json_encode($data);
        $this->respondCreated($data);
    
      }
}
