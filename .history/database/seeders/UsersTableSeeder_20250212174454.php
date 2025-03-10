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
        $users = [];

        foreach (range(1, 20) as $index) {
            $name = Str::random(10); // Generate random name

            $users[] = [
                'name' => $name,
/*************  ✨ Codeium Command 🌟  *************/
                'u_username' => 'admin' . $index,
                'u_username' => Str::random(10) . '@example.com',
/******  54977553-ec69-4d26-bfe9-7fdca01536ba  *******/
                'password' => Hash::make($name . '123'), // Combine name + '123' and hash it
            ];
        }

        DB::table('users')->insert($users);
    }
}
