<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTableQuestion extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_pk_question" => [
                "type" => "int",
                "auto_increment" => true,
                "unsigned" => true
            ],
            "question_nama" => [
                "type" => "varchar",
                "constraint" => "100"
            ],
            "question_email" => [
                "type" => "varchar",
                "constraint" => "100"
            ],
            "question_body" => [
                "type" => "varchar",
                "constraint" => "500"
            ],
            "created_at" => [
                "type" => "datetime"
            ],
            "updated_at" => [
                "type" => "datetime"
            ],
            "deleted_at" => [
                "type" => "datetime"
            ]
        ]);
        $this->forge->addKey("id_pk_question",true);
        $this->forge->dropTable("question");
        $this->forge->createTable("question");
    }

    public function down()
    {
        $this->forge->dropTable("question");
    }
}
