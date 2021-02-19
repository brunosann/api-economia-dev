<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id" => [
				"type" => "int",
				"constraint" => "11",
				"auto_increment" => true,
				"unsigned" => true,
			],
			"category" => [
				"type" => "varchar",
				"constraint" => "50"
			]
		]);
		$this->forge->addPrimaryKey("id");
		$this->forge->createTable("category");
	}

	public function down()
	{
		$this->forge->dropTable("category");
	}
}
