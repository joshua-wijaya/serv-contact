<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailCollection extends Migration
{
    public function up()
    {
        $columns = array(
            "id_pk_email" => array(
                "type" => "int",
                "unsigned" => true,
                "auto_increment" => true
            ),
            "email" => array(
                "type" => "varchar",
                "constraint" => "100"
            ),
            "is_validated" => array(
                "type" => "tinyint",
                "default" => 0 //0 belom, 1 sudah
            ),
            "is_sent_comprof" => array(
                "type" => "tinyint",
                "default" => 0 //0 belom, 1 sudah
            ),
            "created_at" => array(
                "type" => "datetime"
            ),
            "updated_at" => array(
                "type" => "datetime"
            ),
            "deleted_at" => array(
                "type" => "datetime"
            ),
        );
        $this->forge->addField($columns);
        $this->forge->addKey("id_pk_email", true, true);
        $this->forge->createTable("tbl_email_collection");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_email_collection");
    }
}
