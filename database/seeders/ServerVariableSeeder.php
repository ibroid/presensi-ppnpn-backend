<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServerVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("server_variable")->insert([
            [
                "key" => "app_version",
                "value" => "development-0.0.0",
            ],
            [
                "key" => "app_name",
                "value" => "Presence App",
            ],
            [
                "key" => "app_description",
                "value" => "Aplikasi Presensi Online"
            ],
            [
                "key" => "allow_registration",
                "value" => "false",
            ]
        ]);
    }
}
