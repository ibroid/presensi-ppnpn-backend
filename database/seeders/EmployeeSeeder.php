<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "id" => 2,
                "fullname" => "Abdullah, S.H.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 05:34:56",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/abdullah-214x300.jpg",
            ],
            [
                "id" => 3,
                "fullname" => "Adi Nurhayadi, S.H.",
                "employee_level_id" => 7,
                "created_at" => "2023-02-23 06:21:30",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/Adi-197x300.jpg",
            ],
            [
                "id" => 5,
                "fullname" => "Syahril",
                "employee_level_id" => 8,
                "created_at" => "2023-02-23 06:24:53",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/syahril-214x300.jpg",
            ],
            [
                "id" => 6,
                "fullname" => "Deni Yanti",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:26:10",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/yanti-214x300.jpg",
            ],
            [
                "id" => 7,
                "fullname" => "Della Ana Safitri, S.H.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:27:00",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/dela-214x300.jpg",
            ],
            [
                "id" => 8,
                "fullname" => "Aroyani Jasid, S.E.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:27:53",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/ochy-214x300.jpg",
            ],
            [
                "id" => 9,
                "fullname" => "Iwan Ridwanto",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:28:29",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/Iwan-214x300.jpg",
            ],
            [
                "id" => 10,
                "fullname" => "Ade Triyanto, S.H.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:29:02",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/atrianto-214x300.jpg",
            ],
            [
                "id" => 11,
                "fullname" => "Haryanto",
                "employee_level_id" => 8,
                "created_at" => "2023-02-23 06:29:36",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/Haryanto_-200x300.jpg",
            ],
            [
                "id" => 12,
                "fullname" => "Cakra Satria Wibawa, S.H.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:30:15",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/cakra-214x300.jpg",
            ],
            [
                "id" => 13,
                "fullname" => "Muhammad Syafrudy, S.Kom.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:30:55",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/syafrudi-214x300.jpg",
            ],
            [
                "id" => 15,
                "fullname" => "Maulana Malik Ibrahim, S.Kom.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:32:13",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/imal-214x300.jpg",
            ],
            [
                "id" => 17,
                "fullname" => "Rudy Iswahyudi, S.Kom.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:33:16",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/Rudy-214x300.jpeg",
            ],
            [
                "id" => 18,
                "fullname" => "Abdul Salam, A.Md.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:33:45",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/salam-214x300.jpg"
            ],
            [
                "id" => 19,
                "fullname" => "A. Muh. Afrialdi",
                "employee_level_id" => 8,
                "created_at" => "2023-02-23 06:34:29",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/Aldi-Security-683x1024.png",
            ],
            [
                "id" => 20,
                "fullname" => "Faiz Maulana Putra, S.Kom.",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 06:34:58",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/Faiz.png",
            ],
            [
                "id" => 1,
                "fullname" => "Aulia Apriliani. A.Md",
                "employee_level_id" => 6,
                "created_at" => "2023-02-23 02:38:34",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/aulia-214x300.jpg",
            ],
            [
                "id" => 14,
                "fullname" => "Syamsuri",
                "employee_level_id" => 8,
                "created_at" => "2023-02-23 06:31:37",
                "updated_at" => null,
                "photos" => "https://pa-jakartautara.go.id/wp-content/uploads/2018/08/syamsuri-214x300.jpg",
            ],
        ];

        array_push(
            $data,
            [
                "id" => 31,
                "fullname" => "Drs. H. Safe`I Agustian",
                "employee_level_id" => 1,
                "created_at" => "2023-02-23 06:31:37",
                "updated_at" => null,
                "photos" => "https://images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_formal/25729.jpg&w=120",
            ],
            [
                "id" => 32,
                "fullname" => "Riska Mizalfi, S.Kom., M.H.",
                "employee_level_id" => 2,
                "created_at" => "2023-02-23 06:31:37",
                "updated_at" => null,
                "photos" => "https://images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_formal/1867.jpg&w=120",
            ],
            [
                "id" => 33,
                "fullname" => "Hiram Sulistio Sibarani, S.Kom.",
                "employee_level_id" => 3,
                "created_at" => "2023-02-23 06:31:37",
                "updated_at" => null,
                "photos" => "https://images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_formal/29480.png&w=120",
            ],
            [
                "id" => 34,
                "fullname" => "Najamudin, S.Ag., S.H., M.H.",
                "employee_level_id" => 4,
                "created_at" => "2023-02-23 06:31:37",
                "updated_at" => null,
                "photos" => "https://images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_formal/29689.jpg&w=120",
            ],
            [
                "id" => 35,
                "fullname" => "Puspita Oktariandini Putri, S.Sos.",
                "employee_level_id" => 5,
                "created_at" => "2023-02-23 06:31:37",
                "updated_at" => null,
                "photos" => "https://images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_formal/37770.jpg&w=120",
            ],
        );

        DB::table('employees')->insert($data);
    }
}
