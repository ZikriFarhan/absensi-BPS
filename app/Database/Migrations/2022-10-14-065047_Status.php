<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Status extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                 => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_status'       => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('Status', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('Status', TRUE);
    }
}
