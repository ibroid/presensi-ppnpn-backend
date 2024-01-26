<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("user_employee")->insert([
            [
                "user_id" => 1,
                "employee_id" => 15,
                "created_at" => now(),
            ],
            [
                "user_id" => 2,
                "employee_id" => 31,
                "created_at" => now(),
            ],
            [
                "user_id" => 3,
                "employee_id" => 31,
                "created_at" => now(),
            ],
            [
                "user_id" => 4,
                "employee_id" => 33,
                "created_at" => now(),
            ],
            [
                "user_id" => 5,
                "employee_id" => 34,
                "created_at" => now(),
            ],
            [
                "user_id" => 6,
                "employee_id" => 35,
                "created_at" => now(),
            ],
        ]);
    }
}
