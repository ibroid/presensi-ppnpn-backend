<?php

namespace App\Report;

use App\Models\DailyPresence;
use App\Models\Employee;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;

class PresenceReport
{

  /**
   * Retrieves data for the given date including employee attendance times.
   *
   * @param string $date The date for which data is fetched
   * @return Collection Collection of employee data with attendance times
   */
  public static function dailyData(string $date): Collection
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

  public static function monthlyData($bulan, $tahun, $employee_id)
  {

    $data = Employee::with("employee_level")
      ->with(["daily_present" => function (Builder $q) use ($tahun, $bulan) {
        $q
          ->whereMonth("present_date", $bulan)
          ->whereYear("present_date", $tahun);
      }])
      ->find($employee_id);

    return $data;
  }

  public static function dateRangeMonth($bulan, $tahun)
  {
    $dateRange = Collection::make();
    $firstDate = date("Y-m-01", strtotime($tahun . "-" . $bulan . "-01"));

    $lastDate = date("Y-m-t", strtotime($tahun . "-" . $bulan . "-01"));


    $current = $firstDate;
    while ($current <= $lastDate) {
      $dateRange->push(Date::parse($current));
      $current = date("Y-m-d", strtotime("+1 day", strtotime($current)));
    }

    return $dateRange;
  }

  public static function export($request)
  {

    $data = self::monthlyData($request->bulan ?? date("m"), $request->tahun ?? date("Y"), $request->employee_id ?? $request->user()->employee->id);

    $dateRange = self::dateRangeMonth($request->bulan, $request->tahun);

    $template = new TemplateProcessor(Storage::disk("templ")->path("doc/template_laporan_bulanan.docx"));

    $template->setValues([
      "bulan" => $dateRange[0]->monthName,
      "tahun" => $dateRange[0]->format("Y"),
      "nama" => $data->fullname,
      "jabatan" => $data->employee_level->level_name,
    ]);

    $totalMinutes = 0;

    $template->cloneRowAndSetValues("no", $dateRange->map(function ($item, int $y) use ($data, &$totalMinutes) {
      $presensi = $data->daily_present->where("present_date", "=", $item->format("Y-m-d"));

      $masuk = $presensi->where("session", "=", 1)->first();
      $pulang = $presensi->where("session", "=", 2)->first();

      if ($pulang && $masuk) {
        $start = Date::parse($item->format("Y-m-d") . " " . $masuk->present_time);

        $end = Date::parse($item->format("Y-m-d") . " " . $pulang->present_time);

        $diff = explode("-", $start->diff($end)->format("%h-%I"));
        $totalMinutes += (intval($diff[0] * 60)) + intval($diff[1]);
        $diffStr = $diff[0] . " Jam," . $diff[1] . " Menit";
      }

      return [
        "no" => $y + 1,
        "tanggal" => $item->format("d F Y"),
        "hari" => $item->dayName,
        "masuk" => $masuk->present_time ?? null,
        "pulang" => $pulang->present_time ?? null,
        "total" => $diffStr ?? null,
        "ket" => DailyPresence::keteranganList($masuk->status ?? 0)
      ];
    })->all());
    $totalHours = floor($totalMinutes / 60); // Menghitung total jam
    $remainingMinutes = $totalMinutes % 60; // Menghitung sisa menit setelah diubah ke jam

    $template->setValue("total_in", "{$totalHours} Jam {$remainingMinutes} Menit");


    $filename = "LPB_" . $dateRange[0]->monthName . "_" . $dateRange[0]->format("Y") . str_replace(" ", "_", $data->fullname)  . ".docx";

    $fullpath = Storage::disk("templ")->path($filename);
    $template->saveAs($fullpath);

    return response()->download($fullpath)->deleteFileAfterSend(true);
  }
}
