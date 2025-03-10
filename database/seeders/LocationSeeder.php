<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder {
    public function run() {
        $locations = [
            ['l_id' => 1, 'located_at' => 'Canlubang'],
            ['l_id' => 2, 'located_at' => 'Makati'],
            ['l_id' => 3, 'located_at' => 'Westside'],
            ['l_id' => 4, 'located_at' => 'Cebu'],
            ['l_id' => 5, 'located_at' => 'Davao'],
        ];
        Location::insert($locations);
    }
}
