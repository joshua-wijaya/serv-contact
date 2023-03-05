<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model{
  protected $table = "contact";
  protected $primaryKey = "id_pk_contact";
  protected $returnType = "array";
  protected $useSoftDeletes = true;
  protected $allowedFields = ["contact_name", "contact_email", "contact_company", "contact_mobile_num", "contact_company_addr"];

  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $validationRules = [
    "contact_name" => "required",
    "contact_email" => "required|valid_email",
    "contact_company" => "required",
    "contact_mobile_num" => "required",
    "contact_company_addr" => "required",
  ];
  
}