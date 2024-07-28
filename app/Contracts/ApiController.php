<?php

namespace App\Contracts;

interface ApiController
{
  public function return(string $value);
  public function returnError(string $value, int $status);
}
