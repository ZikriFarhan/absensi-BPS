<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PesertaMagang extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'id_bidang'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'id_universitas'     => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],

            'nama'      => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'nim'           => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->addForeignKey('id_bidang', 'Bidang', 'id', 'CASCADE');
        $this->forge->addForeignKey('id_universitas', 'Universitas', 'id', 'CASCADE');

        $this->forge->createTable('PesertaMagang', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('PesertaMagang', TRUE);
    }
}
