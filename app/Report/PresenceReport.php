<?php

namespace App\Report;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PresenceReport
{

  /**
   * Retrieves data for the given date including employee attendance times.
   *
   * @param string $date The date for which data is fetched
   * @return Collection Collection of employee data with attendance times
   */
  public static function data(string $date): Collection
  {
    $selectRaw = "(select present_time from daily_present where date(present_date) = ? and session = ? and daily_present.employee_id = employees.id)";

    $masuk = Str::replaceArray('?', [$date, 1], $selectRaw);
    $pulang = Str::replaceArray('?', [$date, 2], $selectRaw);

    return DB::table('employees')
      ->select('employees.*')
      ->selectRaw("$masuk as masuk, $pulang as pulang")
      ->orderBy('masuk', 'asc')
      ->where('employee_level_id', '>', 5)
      ->get();
  }
}
