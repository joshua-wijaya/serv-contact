<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailCollectionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_email_collection';
    protected $primaryKey       = 'id_pk_email';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ["email", "is_validated", "is_sent_comprof"];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ["check_bruteforce"];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function check_bruteforce(array $data){

        $sql = "select count(id_pk_email) as jmlh_email from tbl_email_collection where email = :email: and created_at <= now() - INTERVAL 1 HOUR";
        $array = array(
            "email" => $data["data"]["email"]
        );
        $db = db_connect();
        $result = $db->query($sql, $array)->getResult("array");
            if($result[0]["jmlh_email"] > 2){
            $returnData = array(
                "status" => false,
            );
            echo json_encode($returnData);
            exit();
        }
        return $data;
    }
    
}
