<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CountryModel extends Model
{
  public function getCountry(): string
  {
    $record = DB::table('country')->inRandomOrder()->first();
    if ($record === null) {
      return "";
    }
    return $record->Name;
  }
}