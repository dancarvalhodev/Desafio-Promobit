<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductTag extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'tag_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
        ]);
            
        $this->forge->addKey(['product_id', 'tag_id'], true);
        $this->forge->createTable('product_tag');
        $this->db->query('ALTER TABLE `product_tag` ADD FOREIGN KEY(`product_id`) REFERENCES `product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `product_tag` ADD FOREIGN KEY(`tag_id`) REFERENCES `tag`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->forge->dropTable('product_tag');
    }
}
