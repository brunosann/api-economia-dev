<?php

namespace App\Filters;

use App\Libraries\HandleJWT;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$token = str_replace('Bearer ', '', $request->getHeaderLine('Authorization'));
		$tokenDecode = HandleJWT::verifToken($token);

		if (!$tokenDecode['valid']) {
			header("HTTP/1.0 401");
			$json = json_encode(['data' => [], 'error' => 'Não autorizado']);
			die($json);
		}

		$request->userData = $tokenDecode['data'];
	}


	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
	}
}
