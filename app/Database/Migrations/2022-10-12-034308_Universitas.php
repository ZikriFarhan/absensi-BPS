<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Universitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_universitas'      => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('Universitas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('Universitas', TRUE);
    }
}
