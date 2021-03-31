<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixedExpense extends Migration
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
			"expense" => [
				"type" => "varchar",
				"constraint" => "255",
			],
			"value" => [
				"type" => "decimal",
				"constraint" => "15,2",
			],
			"id_user" => [
				"type" => "int",
				"constraint" => "11"
			],
			"id_category" => [
				"type" => "int",
				"constraint" => "11",
				"default" => 4,
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
		$this->forge->createTable("fixed_expense");
	}

	public function down()
	{
		$this->forge->dropTable("fixed_expense");
	}
}
