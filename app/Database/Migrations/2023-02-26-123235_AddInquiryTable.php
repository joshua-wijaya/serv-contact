<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInquiryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_pk_inquiry" => [
                "type" => "int",
                "auto_increment" => true,
                "unsigned" => true
            ],
            "inquiry_nama" => [
                "type" => "varchar",
                "constraint" => 100
            ],
            "inquiry_email" => [
                "type" => "varchar",
                "constraint" => 100
            ],
            "inquiry_perusahaan" => [
                "type" => "varchar",
                "constraint" => 100
            ],
            "inquiry_subject" => [
                "type" => "varchar",
                "constraint" => 200,
            ],
            "inquiry_message" => [
                "type" => "varchar",
                "constraint" => 2000,
            ],
            "inquiry_message" => [
                "type" => "varchar",
                "constraint" => 2000,
            ],
            "inquiry_message" => [
                "type" => "varchar",
                "constraint" => 2000,
            ],
            "created_at" => [
                "type" => "datetime"
            ],
            "updated_at" => [
                "type" => "datetime"
            ],
            "deleted_at" => [
                "type" => "datetime"
            ],
        ]);
        $this->forge->addKey("id_pk_inquiry",true,true);
        $this->forge->createTable("inquiry");
    }

    public function down()
    {
        $this->forge->dropTable("inquiry");
    }
}
