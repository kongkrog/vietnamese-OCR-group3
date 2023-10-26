<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreationTableUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique' => true
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ]
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
