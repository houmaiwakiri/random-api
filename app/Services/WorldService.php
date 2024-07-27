<?php

namespace App\Services;

use App\Contracts\ApiController;

class WorldService implements ApiController
{
  /**
   * Return Success with Status 200
   * @param string $value
   * @return string
   */
  public function return(string $value, int $status = 200): string
  {
    return response()->json([
      'status' => $status,
      'data' => [
        'country' => $value,
      ]
    ], 200);
  }
  /**
   * Return Error with Status 500
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