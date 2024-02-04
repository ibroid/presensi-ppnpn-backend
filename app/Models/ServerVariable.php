<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerVariable extends Model
{
    use HasFactory;

    protected $table = "server_variable";

    protected $guarded = [];
}
