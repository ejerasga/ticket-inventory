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

        foreach (range(1, 20) as $index) {

            $users[] = [
                'u_username' => Str::random(10) . '@example.com',
                'u_password' => Hash::make(Str::random(10) . '123'), 
                'u_fname' => S
            ];
        }

        DB::table('users')->insert($users);
    }
}
