<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
			"name" => [
				"type" => "varchar",
				"constraint" => "100",
			],
			"email" => [
				"type" => "varchar",
				"constraint" => "150",
			],
			"password" => [
				"type" => "varchar",
				"constraint" => "255",
			],
			"birth_date" => [
				"type" => "DATETIME",
			],
			"created_at" => [
				"type" => "DATETIME",
			],
			"updated_at" => [
				"type" => "DATETIME",
			],
			"deleted_at" => [
				"type" => "DATETIME",
				"null" => true,
				"default" => NULL,
			],
		]);
		$this->forge->addPrimaryKey("id");
		$this->forge->createTable("user");
	}

	public function down()
	{
		$this->forge->dropTable("user");
	}
}
