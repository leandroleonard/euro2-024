<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Team extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    => true
            ],
            'name'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 200,
                'null'              => false,
            ],
            'description'   => [
                'type'              => 'TEXT',
                'null'              => true
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('team');
    }

    public function down()
    {
        $this->forge->dropTable('blog');
    }
}
