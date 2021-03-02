<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\HandleJWT;
use CodeIgniter\Config\Factories;

class RevenueController extends BaseController
{
	private $revenueModel;

	public function __construct()
	{
		$this->revenueModel = Factories::models('RevenueModel');
	}

	public function add()
	{
		$token = str_replace('Bearer ', '', $this->request->getHeaderLine('Authorization'));
		$tokenDecode = HandleJWT::verifToken($token);
		if (!$tokenDecode['valid']) return $this->response->setStatusCode(401)->setJSON(['data' => [], 'error' => 'Não autorizado']);

		$json = $this->request->getJSON();
		$valid = \Config\Services::validation();
		$checkFields = $valid->run(get_object_vars($json), 'revenue');
		$errors = $valid->getErrors();

		if (!$checkFields) return $this->response->setJSON(['data' => [], 'error' => $errors]);

		$json->id_user = $tokenDecode['data']->id;
		$this->revenueModel->insert($json);

		return $this->response->setJSON(['data' => [], 'error' => []]);
	}

	public function getAll()
	{
		$getMonth = $this->request->getGet('month');
		$getYear = $this->request->getGet('year');
		$month = $getMonth ? $getMonth : date('m');
		$year = $getYear ? $getYear : date('Y');
		$data = $this->revenueModel->where(['MONTH(created_at)' => $month, 'YEAR(created_at)' => $year])->findAll();
		return $this->response->setJSON(['data' => $data, 'error' => []]);
	}
}
