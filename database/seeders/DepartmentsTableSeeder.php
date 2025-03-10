<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['d_name' => 'MIS'],
            ['d_name' => 'TSD'],
            ['d_name' => 'IE'],
            ['d_name' => 'SALES'],
            ['d_name' => 'PPIC'],
            ['d_name' => 'SAFETY'],
            ['d_name' => 'WAREHOUSE'],
            ['d_name' => 'QA'],
            ['d_name' => 'GPRO'],
            ['d_name' => 'SPRO'],
            ['d_name' => 'ACCUBEND'],
            ['d_name' => 'AIM'],
            ['d_name' => 'ACCOUNTING'],
            ['d_name' => 'HRD'],
            ['d_name' => 'DELIVERY'],
            ['d_name' => 'CAD'],
        ]);        
    }
}
