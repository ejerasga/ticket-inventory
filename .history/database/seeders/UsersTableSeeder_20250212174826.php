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

        foreach (range(1, 5) as $index) {

            $users[] = [
                'u_username' => Str::random(10),
                'u_password' => Hash::make(Str::random(10) . '123'), 
                'u_fname' => Str::random(10),


            ];
        }

        DB::table('users')->insert($users);
    }
/******  11c026b4-c9b7-4465-8345-5eddf5d79f41  *******/
}
