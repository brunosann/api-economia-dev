<?php

namespace App\Models;

use CodeIgniter\Model;

class RevenueModel extends Model
{
	protected $table = 'revenue';
	protected $primaryKey = 'id';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['value', 'description', 'id_user'];

	protected $useTimestamps = true;
}
