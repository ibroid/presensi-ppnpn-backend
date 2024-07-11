<?php

namespace App\Report;

use App\Models\Employee;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;

class ActivityReport
{

  /**
   * Constructor for the ActivityReport class.
   *
   * @param int $employeeId The ID of the employee.
   * @param string $fullDate The full date.
   * @param string $month The month.
   * @param string $year The year.
   */
  public function __construct(
    protected int $employeeId,
    protected string $month,
    protected string $year,
    protected string $fullDate,
  ) {
  }

  /**
   * Create a new ActivityReport instance with the current month, full date, and year.
   * @return static
   */
  public static function make(int $employeeId, $fullDate = null, $month = null, $year = null)
  {
    return new static($employeeId, $fullDate ?? date("Y-m-d"), $month ?? date("m"), $year ?? date("Y"));
  }

  /**
   * Retrieve the data for a specific employee in a given month and year.
   *
   * @return Model|Collection The employee data with associated levels and daily activities.
   */
  public function getDataInMonthAndYear(): Model|Collection
  {
    return Employee::with("employee_level")
      ->with(["daily_activity" => function (Builder $q) {
        $q
          ->whereMonth("doing_date", $this->month)
          ->whereYear("doing_date", $this->year);
      }])

      ->find($this->employeeId);
  }

  /**
   * Generate a collection of dates within the given month and year.
   *
   * @return \Illuminate\Support\Collection<Date> A collection of dates.
   */
  public function getDateRange(): Collection
  {
    $dateRange = Collection::make();

    $firstDate = date("Y-m-01", strtotime($this->year . "-" . $this->month . "-01"));
    $lastDate = date("Y-m-t", strtotime($this->year . "-" . $this->month . "-01"));

    $current = $firstDate;

    while ($current <= $lastDate) {
      $dateRange->push(Date::parse($current));
      $current = date("Y-m-d", strtotime("+1 day", strtotime($current)));
    }

    return $dateRange;
  }
}
