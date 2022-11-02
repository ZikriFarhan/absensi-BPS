<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kehadiran extends Migration
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
            'nama_kehadiran'    => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('Kehadiran', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('Kehadiran', TRUE);
    }
}
