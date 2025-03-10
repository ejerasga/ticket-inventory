<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'email' => Str::random(10) . '@example.com',
            'password' => Hash::make($name . '123'), // Combine name + '123' and hash it
        ];
    }

    DB::table('users')->insert($users);
}
}
