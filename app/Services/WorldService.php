<?php

namespace App\Services;

use App\Contracts\ApiController;

class WorldService implements ApiController
{
  /**
   * Summary of return
   * @param string $value
   * @return string
   */
  public function return(string $value): string
  {
    return response()->json([
      'status' => '200',
      'data' => [
        'country' => $value,
      ]
    ], 200);
  }
  /**
   * Summary of returnError
   * @param string $error
   * @param int $status
   * @return string
   */
  public function returnError(string $error, int $status = 500): string
  {
    return response()->json([
      'status' => $status,
      'data' => [
        'message' => $error,
      ]
    ], $status);
  }
}