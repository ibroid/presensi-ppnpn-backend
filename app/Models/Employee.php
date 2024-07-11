<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Retrieve the employee's level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee_level()
    {
        return $this->belongsTo(EmployeeLevel::class);
    }

    /**
     * Retrieve the daily presence records for this employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function daily_present(): HasMany
    {
        return $this->hasMany(DailyPresence::class);
    }

    /**
     * Retrieve the daily activity records for this employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function daily_activity()
    {
        return $this->hasMany(DailyActivity::class);
    }
}
