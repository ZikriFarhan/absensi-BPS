<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Presensi extends Migration
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
            'id_kehadiran'     => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'id_status'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'nim'                => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'tanggal'        => [
                'type'       => 'DATE',
            ],
            'jam_masuk'      => [
                'type'       => 'TIME',
            ],
            'jam_keluar'      => [
                'type'       => 'TIME',
            ],
            'keterangan'      => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->addForeignKey('nim', 'PesertaMagang', 'nim', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kehadiran', 'Kehadiran', 'id', 'CASCADE');
        $this->forge->addForeignKey('id_status', 'Status', 'id', 'CASCADE');

        $this->forge->createTable('Presensi', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('Presensi', TRUE);
    }
}
