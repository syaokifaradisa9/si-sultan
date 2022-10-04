<?php

namespace App\Helpers;

class ApiFormatter
{
  protected static $response = [
    'status' => null,
    'data' => null
  ];

  public static function createdApi($code = null, $data = null)
  {
    self::$response['status'] = $code;
    self::$response['data'] = $data;

    return response()->json(self::$response, self::$response['status']);
  }
}
