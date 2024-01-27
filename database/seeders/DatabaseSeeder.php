<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $empSeed = new EmployeeLevelSeeder();
        $empLvSeed = new EmployeeLevelSeeder();
        $roleSeed = new RoleSeeder();
        $usrEmpSeed = new UserEmployeeSeeder();
        $usrSeed = new UserSeeder();

        $empLvSeed->run();
        $empSeed->run();
        $roleSeed->run();
        $usrEmpSeed->run();
        $usrSeed->run();
    }
}
