<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder {
    public function run() {
        $services = [
            ['s_id' => 1, 's_name' => 'Network'],
            ['s_id' => 2, 's_name' => 'IT Device'],
            ['s_id' => 3, 's_name' => 'Wifi Voucher'],
        ];
        Service::insert($services);
    }
}

