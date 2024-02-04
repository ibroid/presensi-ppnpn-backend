<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("app_version")->insert([
            "tags" => "development_version",
            "major_changes" => 0,
            "minor_changes" => 0,
            "fix_bug" => 0,
            "status" => "current"
        ]);
    }
}
