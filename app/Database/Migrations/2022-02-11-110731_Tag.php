<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tag extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => true,
            ],
        ]);
            
        $this->forge->addKey('id', true);
        $this->forge->createTable('tag');
    }

    public function down()
    {
        $this->forge->dropTable('tag');
    }
}
