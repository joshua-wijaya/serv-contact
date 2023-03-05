<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveContactTable extends Migration
{
    public function up()
    {
        $this->forge->dropTable("contact");
    }

    public function down()
    {
        //
    }
}
