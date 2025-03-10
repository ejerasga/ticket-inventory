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
/*************  ✨ Codeium Command 🌟  *************/
    public function run(): void
    {
        foreach (range(0, 4) as $index) {
        foreach (range(1, 5) as $index) {
            $username = Str::random(10);
            $users[] = [
                'u_username' => 'admin' . ($index === 0 ? '' : $index),
                'u_password' => Hash::make('admin'),
                'u_username' => $username,
                'u_password' => Hash::make($username . '123'),
                'u_fname' => Str::random(10),
                'u_mname' => Str::random(1),
                'u_lname' => Str::random(10),
                'u_gender' => rand(0, 1),
                'u_contact' => Str::random(10),
                'r_id' => rand(1, 3), //roles ids are between 1 and 3
                'd_id' => rand(1, 16), // department ids are between 1 and 16
            ];
        }

        DB::table('users')->insert($users);
    }
/******  3269dca5-94ad-467c-9e6d-2110f7b8752d  *******/
}
