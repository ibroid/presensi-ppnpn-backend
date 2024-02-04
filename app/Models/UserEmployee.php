<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmployee extends Model
{
    use HasFactory;
    protected $table = "user_employee";
    protected $guarded = [];
}
