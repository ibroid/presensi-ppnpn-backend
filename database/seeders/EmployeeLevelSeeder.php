<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_levels')->insert([
            [
                "id" => 1,
                "level_name" => "Sekretaris",
                "level_position" => "Single",
            ],
            [
                "id" => 2,
                "level_name" => "Kepala Sub Bagian Umum",
                "level_position" => "Single",
            ],
            [
                "id" => 3,
                "level_name" => "Kepala Sub Bagian Kepegawaian",
                "level_position" => "Single",
            ],
            [
                "id" => 4,
                "level_name" => "Kepala Sub Bagian Teknologi Informasi",
                "level_position" => "Single",
            ],
            [
                "id" => 5,
                "level_name" => "Staff Kasub Umum",
                "level_position" => "Multiple",
            ],
            [
                "id" => 6,
                "level_name" => "Pramubakti",
                "level_position" => "Multiple",
            ],
            [
                "id" => 7,
                "level_name" => "Supir",
                "level_position" => "Multiple",
            ],
            [
                "id" => 8,
                "level_name" => "Security",
                "level_position" => "Multiple",
            ],
        ]);
    }
}
