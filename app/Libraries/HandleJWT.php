<?php

namespace App\Libraries;

use Firebase\JWT\JWT;

class HandleJWT
{
  public static function createToken($data)
  {
    $issuedAt = time();
    $expire = $issuedAt + 86400; // 24hr
    $payload = [
      'iat'  => $issuedAt,            // timestamp de geracao do token
      'exp'  => $expire,              // expiracao do token
      'nbf'  => $issuedAt - 1,        // token nao eh valido Antes de
      'data' => $data, // Dados do usuario logado
    ];
    return JWT::encode($payload, $_ENV['JWT_KEY']);
  }

  public static function verifToken($token)
  {
    try {
      $decode = JWT::decode($token, $_ENV['JWT_KEY'], ['HS256']);
      return ['valid' => true, 'data' => $decode->data];
    } catch (\Throwable $th) {
      return ['valid' => false];
    }
  }
}
