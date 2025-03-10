<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 5) as $index) {
            $users[] = [
                'u_username' => Str::random(10),
                'u_password' => Hash::make(Str::random(10) . '123'),
                'u_fname' => Str::random(10),
                'u_mname' => Str::random(1),
                'u_lname' => Str::random(10),
                'u_gender' => rand(0, 1),
                'u_contact' => Str::random(10),
                'r_id' => rand(1, 3), // ids are between 1 and 3
                'd_id' => rand(1, 16), // Assuming department ids are between 1 and 5
            ];
        }

        DB::table('users')->insert($users);
    }
}
