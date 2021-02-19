<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table      = 'user';
  protected $primaryKey = 'id';

  protected $returnType     = 'object';
  protected $useSoftDeletes = true;

  protected $allowedFields = ['name', 'email', 'password', 'birth_date'];

  protected $useTimestamps = true;

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}
