<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyContactTableContactCompanyAddr extends Migration
{
    public function up()
    {
        
        $fields = [
            'contact_componay_addr' => [
                'name' => 'contact_company_addr',
                'type' => 'varchar(400)'
            ],
        ];
        $this->forge->modifyColumn('contact', $fields);
    }

    public function down()
    {
        //
    }
}
