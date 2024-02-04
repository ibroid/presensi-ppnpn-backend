<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    use HasFactory;

    protected $table = "app_version";
    protected $guarded = [];

    public function getFullAppVersionAttribute(): string
    {
        return $this->tags . "-" . $this->major_changes . "." . $this->minor_changes . "." . $this->fix_bug;
    }

    public static function current(): AppVersion
    {
        return self::where("status", "=", "current")->first();
    }
}
