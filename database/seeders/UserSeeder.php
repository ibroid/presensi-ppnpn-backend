<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultSalt = "123";
        $defaultPassword = Hash::make("paju" . $defaultSalt);
        DB::table("users")->insert([
            [
                "id" => 1,
                "identifier" => "089636811489",
                "name" => "Maulana Malik",
                "password" => $defaultPassword,
                "salt" => $defaultSalt,
                "role_id" => 1
            ],
            [
                "id" => 2,
                "identifier" => "08121405095",
                "name" => "Drs. H. Safe`I Agustian",
                "password" => $defaultPassword,
                "salt" => $defaultSalt,
                "role_id" => 3
            ],
            [
                "id" => 3,
                "identifier" => "081316885577",
                "name" => "Riska Mizalfi, S.Kom., M.H.",
                "password" => $defaultPassword,
                "salt" => $defaultSalt,
                "role_id" => 3
            ],
            [
                "id" => 4,
                "identifier" => "087884551130",
                "name" => "Hiram Sulistio Sibarani, S.Kom.",
                "password" => $defaultPassword,
                "salt" => $defaultSalt,
                "role_id" => 3
            ],
            [
                "id" => 5,
                "identifier" => "081717181177",
                "name" => "Najamudin, S.Ag., S.H., M.H.",
                "password" => $defaultPassword,
                "salt" => $defaultSalt,
                "role_id" => 3
            ],
            [
                "id" => 6,
                "identifier" => "087749808285",
                "name" => "Puspita Oktariandini Putri, S.Sos.",
                "password" => $defaultPassword,
                "salt" => $defaultSalt,
                "role_id" => 3
            ],
        ]);
    }
}
