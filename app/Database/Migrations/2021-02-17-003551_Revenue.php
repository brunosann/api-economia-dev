<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Revenue extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id" => [
				"type" => "int",
				"constraint" => 11,
				"unsigned" => true,
				"auto_increment" => true,
			],
			"value" => [
				"type" => "decimal",
				"constraint" => "15,2",
			],
			"description" => [
				"type" => "varchar",
				"constraint" => "255",
				"null" => true,
			],
			"id_user" => [
				"type" => "int",
				"constraint" => "11"
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
		$this->forge->createTable("revenue");
	}

	public function down()
	{
		$this->forge->dropTable("revenue");
	}
}
