<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseFixedModel extends Model
{
	protected $table = 'fixed_expense';
	protected $primaryKey = 'id';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['value', 'expense', 'id_user'];

	protected $useTimestamps = true;
}
