<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmailCollectionModel;
use CodeIgniter\API\ResponseTrait;

use CodeIgniter\Email\Email;

class EmailCollection extends BaseController
{
    use ResponseTrait;
    private function sendEmail($sendTo)
    {
        echo getenv("SMTP_USER");
        echo getenv("SMTP_PASS");
        $config = [
            // 'protocol' => 'smtp',
            'protocol' => 'smtp',
            'SMTPHost' => 'smtp.gmail.com',
            'SMTPPort' => 587,  
            'SMTPCrypto' => 'tls',
            'SMTPUser' => getenv("SMTP_USER"), // Replace with your Google Workspace email address
            'SMTPPass' => getenv("SMTP_PASS"), // Replace with your Google Workspace email password
            'mailType' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $email = new Email($config);
        $email->setFrom(getenv("SMTP_USER"),getenv("SMTP_USER_ALIAS")); // Replace with your Google Workspace email address
        $email->setTo($sendTo); // Replace with the recipient's email address
        $bcc = array(
            "joshua.wijaya@tokeninlah.com",
            "joshua.langoy@tokeninlah.com",
            "sean.michael@tokeninlah.com",
        );
        $email->setBCC($bcc);
        $email->setSubject('Test email');
        $email->setMessage('This is a test email sent from CodeIgniter 4.');
        
        $path = ROOTPATH."files\\Company Profile - Tokeninlah (1).pdf";
        $email->attach($path);

        if ($email->send()) {
            // echo 'Email sent successfully!';
        } else {
            echo $email->printDebugger();
        }
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

        if($insertId){
            $this->sendEmail($data["email"]);
        }
    }
}
