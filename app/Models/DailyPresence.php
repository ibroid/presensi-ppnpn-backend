<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyPresence extends Model
{
    use HasFactory;

    protected $table = 'daily_present';
    protected $guarded = [];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public static function keteranganList($index)
    {
        $data = [
            "Nihil",
            "Hadir",
            "Cuti",
            "Sakit",
            "Ijin",
            "Dinas Luar",
        ];

        return $data[$index] ?? null;
    }
}
