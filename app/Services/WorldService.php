<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Contracts\ApiController;

class WorldService implements ApiController
{
  protected $request;
  public function __construct(Request $request)
  {
    $this->request = $request;
  }
  /**
   * Return Success with Status 200
   * @param string $value
   * @return string
   */
  public function return(string $value, int $status = 200): string
  {
    Log::channel('access')->info('[' . $this->request->fullUrl() . '] ' . $value);
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
    Log::channel('access')->error('[' . $this->request->fullUrl() . '] ' . $error);
    return response()->json([
      'status' => $status,
      'data' => [
        'message' => $error,
      ]
    ], $status);
  }
}