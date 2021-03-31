<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\HandleJWT;
use CodeIgniter\Config\Factories;

class ExpenseController extends BaseController
{
	private $expenseModel;

	public function __construct()
	{
		$this->expenseModel = Factories::models('ExpenseModel');
	}

	public function add()
	{
		$token = $this->request->getHeaderLine('Authorization');
		$tokenDecode = HandleJWT::verifToken($token);
		if (!$tokenDecode['valid']) return $this->response->setStatusCode(401)->setJSON(['data' => [], 'error' => ['Não autorizado']]);

		$json = $this->request->getJSON();
		$valid = \Config\Services::validation();
		$checkFields = $valid->run(get_object_vars($json), 'expense');
		$errors = $valid->getErrors();

		if (!$checkFields) return $this->response->setJSON(['data' => [], 'error' => $errors]);

		$json->id_user = $tokenDecode['data']->id;
		$this->expenseModel->insert($json);

		return $this->response->setJSON(['data' => [], 'error' => []]);
	}

	public function fixed()
	{
		$token = $this->request->getHeaderLine('Authorization');
		$tokenDecode = HandleJWT::verifToken($token);
		if (!$tokenDecode['valid']) return $this->response->setStatusCode(401)->setJSON(['data' => [], 'error' => ['Não autorizado']]);

		$json = $this->request->getJSON();
		$valid = \Config\Services::validation();
		$checkFields = $valid->run(get_object_vars($json), 'expenseFixed');
		$errors = $valid->getErrors();

		if (!$checkFields) return $this->response->setJSON(['data' => [], 'error' => $errors]);

		$json->id_user = $tokenDecode['data']->id;
		$expenseFixedModel = Factories::models('ExpenseFixedModel');
		$expenseFixedModel->insert($json);

		return $this->response->setJSON(['data' => ['adfdsfsd'], 'error' => []]);
	}

	public function getAll()
	{
		$getMonth = $this->request->getGet('month');
		$getYear = $this->request->getGet('year');
		$month = $getMonth ? $getMonth : date('m');
		$year = $getYear ? $getYear : date('Y');

		$data = $this->expenseModel->where(['MONTH(created_at)' => $month, 'YEAR(created_at)' => $year])->findAll();
		return $this->response->setJSON(['data' => $data, 'error' => []]);
	}
}
