<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
	protected $table = 'expense';
	protected $primaryKey = 'id';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['value', 'description', 'id_user', 'id_category'];

	protected $useTimestamps = true;
}
