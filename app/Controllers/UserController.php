<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Config\Factories;
use App\Libraries\HandleJWT;

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
    $json = $this->request->getJSON();
    $checkFields = $this->valid->run(get_object_vars($json), 'signin');
    $errors = $this->valid->getErrors();

    if (!$checkFields) return $this->response->setJSON(['data' => [], 'error' => $errors]);

    $user = $this->userModel->where('email', $json->email)->first();

    if (!$user) return $this->response->setJSON(['data' => [], 'error' => 'Email ou senha inválidos']);
    $verifPassword = password_verify($json->password, $user->password);
    if (!$verifPassword) return $this->response->setJSON(['data' => [], 'error' => 'Email ou senha inválidos']);

    $name = $user->name;
    $token = HandleJWT::createToken(['name' => $name, 'id' => $user->id]);
    $data = ['name' => $name, 'token' => $token];

    return $this->response->setJSON(['data' => $data, 'error' => []]);
  }

  public function signup()
  {
    $json = $this->request->getJSON();
    $checkFields = $this->valid->run(get_object_vars($json), 'signup');
    $errors = $this->valid->getErrors();

    if (!$checkFields) return $this->response->setJSON(['data' => [], 'error' => $errors]);

    $json->password = password_hash($json->password, PASSWORD_DEFAULT);
    $id = $this->userModel->insert($json);

    if (!$id) return $this->response->setJSON(['data' => [], 'error' => $this->userModel->errors()]);

    $name = $json->name;
    $token = HandleJWT::createToken(['name' => $name, 'id' => $id]);
    $data = ['name' => $name, 'token' => $token];

    return $this->response->setJSON(['data' => $data, 'error' => []]);
  }
}
