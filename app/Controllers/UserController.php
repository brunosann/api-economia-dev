<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Config\Factories;

class UserController extends BaseController
{
  private $valid;
  private $userModel;

  public function __construct()
  {
    $this->valid = \Config\Services::validation();
    $this->userModel = Factories::models('UserModel');
  }

  public function signin()
  {
    return $this->response->setJSON(['msg' => 'success']);
  }

  public function signup()
  {
    $json = $this->request->getJSON(true);
    $checkFields = $this->valid->run($json, 'signup');
    $errors = $this->valid->getErrors();

    if (!$checkFields) return $this->response->setJSON(['data' => [], 'error' => $errors]);

    $json['password'] = password_hash($json['password'], PASSWORD_DEFAULT);
    $this->userModel->insert($json);

    return $this->response->setJSON(['data' => [], 'error' => $errors]);
  }
}
