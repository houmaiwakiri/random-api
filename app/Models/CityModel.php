<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CityModel extends Model
{
  public function getCity(): string
  {
    $record = DB::table('city')->inRandomOrder()->first();
    if ($record === null) {
      return "";
    }
    return $record->Name;
  }
}